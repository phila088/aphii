<?php

use App\Models\BrandEmail;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    public Collection $brandEmails;
    public ?BrandEmail $editing = null;

    public $brand;

    public function mount()
    {
        $this->getBrandEmails();
    }

    #[On('brand-email-created')]
    public function getBrandEmails()
    {
        $this->brandEmails = BrandEmail::where('brand_id', '=', $this->brand->id)
            ->orderBy('title')
            ->get();
    }

    public function delete(BrandEmail $email)
    {
        $this->authorize('brandemails.delete');

        $email->delete();

        $this->dispatch('brand-email-deleted');

        $this->getBrandEmails();
    }

    public function searchResults(string $partial)
    {
        if (!empty($partial)) {
            $this->brandEmails = BrandEmail::query()
                ->where('brand_id', '=', $this->brand->id)
                ->where(function (Builder $query) use ($partial) {
                    $query->where('title', 'like', '%' . $partial . '%')
                        ->orWhere('email', 'like', '%' . $partial . '%');
                })
                ->orderBy('title')
                ->get();
        } else {
            $this->getBrandEmails();
        }
    }

}; ?>

<div>
    <div class="card custom-card">
        <div class="card-body">
            <div class="tw-flex tw-justify-between tw-items-center">
                <h1>All emails</h1>
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
                @can('brandemails.viewany')
                    @empty ($brandEmails[0])
                        <x-no-data />
                    @else
                        @foreach ($brandEmails as $email)
                            <div class="tw-p-6 tw-flex tw-space-x-2">
                                <div class="tw-flex-1">
                                    <div class="tw-flex tw-justify-between tw-items-center">
                                        <div>
                                            <h1>{{ $email->title }}</h1>
                                        </div>
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            @canany (['brandemails.edit', 'brandemails.delete'])
                                                <x-slot name="content">
                                                    @can ('brandemails.edit')
                                                        <x-dropdown-link wire:click="edit({{ $email->id }})">
                                                            {{ __('Edit') }}
                                                        </x-dropdown-link>
                                                    @endcan
                                                    @can ('brandemails.delete')
                                                        <x-dropdown-link wire:click="delete({{ $email->id }})" wire:confirm="Are you sure to delete this address?">
                                                            {{ __('Delete') }}
                                                        </x-dropdown-link>
                                                    @endcan
                                                </x-slot>
                                            @endcanany
                                        </x-dropdown>
                                    </div>
                                    @if ($email->is($editing))
                                        <livewire:employee.brand-emails.edit :email="$email" :key="$email->id" />
                                    @else
                                        <address>
                                            <a href="mailto:{{ $email->email }}">{{ $email->email }}</a>
                                        </address>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endempty
                @else
                    <x-not-auth />
                @endcan
            </div>
        </div>
    </div>
</div>
