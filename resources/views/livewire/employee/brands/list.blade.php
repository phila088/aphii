<?php

use App\Models\Brand;
use App\Models\StatusCode;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $brands;

    public string $search = '';

    public function mount(): void
    {
        $this->getBrands();
    }

    #[On('brand-created')]
    #[On('brand-edited')]
    public function getBrands(): void
    {
        $this->search = '';

        $this->brands = Brand::orderBy('legal_name')
            ->get();
    }

    public function searchResults(string $partial): void
    {
        if (!empty($partial)) {
            $this->brands = Brand::where('legal_name', 'like', '%' . $partial . '%')
                ->orWhere('dba', 'like', '%' . $partial . '%')
                ->orWhere('abbreviation', 'like', '%' . $partial . '%')
                ->orderBy('legal_name')
                ->get();
        } else {
            $this->getBrands();
        }
    }

    public function edit(Brand $brand): void
    {
        if (auth()->user()->can('brands.edit')) {
            redirect()->route('employee.brands.edit', [$brand]);
        } else {
            $this->dispatch('user-not-authorized');
        }
    }

    public function getStatus(Brand $brand)
    {
        $brandStatus = $brand->status;
        $title = StatusCode::select('title')
            ->where('code', '=', $brandStatus)
            ->limit(1)
            ->get();

        return $brand->status . ' - ' . $title[0]->title;
    }

}; ?>

<div>
    <div class="card custom-card">
        <div class="card-body">
            <div class="tw-flex tw-justify-between tw-items-center">
                <h1>All brands</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search" class="tw-py-2 tw-px-3 tw-block tw-w-full tw-border-gray-200 tw-rounded-full tw-text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-body">
            <div class="tw-divide-y dark:tw-divide-gray-700">
                @can('brands.viewany')
                    @if (!empty($brands[0]))
                        @foreach ($brands as $brand)
                            <div class="row g-2 hover:tw-bg-gray-50/[0.7]">
                                <div class="card-body tw-flex tw-align-top">
                                    <p class="avatar avatar-xxl avatar-rounded me-3 my-auto">
                                        <img src="{{ asset($brand->logo_path) }}" alt="">
                                    </p>
                                    <div class="flex-fill main-profile-info my-auto">
                                        <h5 class="fw-bolder">
                                            <a href="{{ route('employee.brands.view', $brand->id) }}">{{ $brand->legal_name }}</a>
                                        </h5>
                                        <div>
                                            <p class="mb-1 text-muted">
                                                DBA: {{ $brand->dba }}
                                            </p>
                                            <p class="mb-1 text-muted">
                                                Abbreviation: {{ $brand->abbreviation }}
                                            </p>
                                            <p class="mb-1 text-muted">
                                                Status: {{ $this->getStatus($brand) }}
                                            </p>
                                            <p class="mb-1 text-muted">
                                                Created: {{ $brand->created_at->format('j M Y, g:i a') }}
                                                @unless ($brand->created_at->eq($brand->updated_at))
                                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                                @endunless
                                            </p>
                                        </div>
                                    </div>
                                    <div class="main-profile-info ms-auto">
                                        <div>
                                            @can ('users.edit')
                                                <x-dropdown>
                                                    <x-slot name="trigger">
                                                        <button>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            </svg>
                                                        </button>
                                                    </x-slot>
                                                    <x-slot name="content">
                                                        <x-dropdown-link wire:click="edit({{ $brand->id }})">
                                                            {{ __('Edit') }}
                                                        </x-dropdown-link>
                                                    </x-slot>
                                                </x-dropdown>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <x-no-data />
                    @endif
                @else
                    <x-not-auth />
                @endcan
            </div>
        </div>
    </div>
</div>
