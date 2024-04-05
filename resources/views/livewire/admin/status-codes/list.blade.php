<?php

use App\Models\StatusCode;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $statusCodes;
    public string $searchTerm = '';

    public ?StatusCode $editing = null;

    public function mount(): void
    {
        $this->getStatusCodes();
    }

    #[On('status-code-created')]
    public function getStatusCodes(): void
    {
        if (empty($this->searchTerm)) {
            $this->statusCodes = StatusCode::orderBy('for_model')
                ->orderBy('title')
                ->orderBy('code')
                ->get();
        } else {
            $this->searchResults($this->searchTerm);
        }
    }

    public function edit(StatusCode $statusCode): void
    {
        $this->editing = $statusCode;

        $this->getStatusCodes();
    }

    #[On('status-code-edit-canceled')]
    #[On('status-code-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getStatusCodes();
    }

    public function delete(StatusCode $statusCode): void
    {
        if (auth()->user()->can('statuscode.delete')) {
            $statusCode->delete();

            $this->getStatusCodes();
        }
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getStatusCodes();
        } else {
            $this->statusCodes = StatusCode::orderBy('code')
                ->where('for_model', 'like', '%' . $partial . '%')
                ->orWhere('code', 'like', '%' . $partial . '%')
                ->orWhere('title', 'like', '%' . $partial . '%')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All status codes</h2>
                <div>
                    <input type="text" id="status-codes-index-search" wire:model="searchTerm" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value)">
                    <label for="payment-methods-index-search" class="tw-sr-only">Search</label>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tw-mt-4 tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700">
                @if ($statusCodes->isEmpty())
                    <x-no-data />
                @else
                    @foreach ($statusCodes as $statusCode)
                        <div class="tw-p-4 tw-flex tw-space-x-2 hover:tw-bg-gray-100 dark:hover:tw-bg-gray-800" wire:key="{{ $statusCode->id }}">
                            <div class="tw-flex-1">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <p class="tw-mt-0.5 tw-text-sm">{{ $statusCode->code }} - {{ $statusCode->title }}</p>
                                    </div>
                                    @canany (['statuscode.edit', 'statuscode.delete'])
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                @can ('statuscode.edit')
                                                    <x-dropdown-link wire:click="edit({{ $statusCode->id }})">
                                                        Edit
                                                    </x-dropdown-link>
                                                @endcan
                                                @can ('statuscode.delete')
                                                    <x-dropdown-link wire:click="delete({{ $statusCode->id }})" wire:confirm="Are you sure you want to delete this status code?">
                                                        Delete
                                                    </x-dropdown-link>
                                                @endcan
                                            </x-slot>
                                        </x-dropdown>
                                    @endcanany
                                </div>
                                <div class="tw-text-xs">
                                    @if ($statusCode->is($editing))
                                        <livewire:admin.status-codes.edit :statusCode="$statusCode" wire:key="$statusCode->id" />
                                    @else
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    Default reason:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ $statusCode->default_reason }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    Created:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Carbon::parse($statusCode->created_at)->timezone(auth()->user()->timezone)->format('m.d.Y G:i A') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
