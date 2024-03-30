<?php

use App\Models\BrandAddress;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public $brand;
    public ?Collection $brandAddresses;

    public ?BrandAddress $editing = null;

    public function mount(): void
    {
        $this->getAddresses();
    }

    #[On('brand-address-created')]
    public function getAddresses(): void
    {
        $this->brandAddresses = BrandAddress::with('user', 'brand')
            ->where('brand_id', '=', $this->brand->id)
            ->orderBy('title')
            ->get();
    }

    public function edit(BrandAddress $address)
    {
        $this->editing = $address;

        $this->getAddresses();
    }

    #[On('brand-address-edit-canceled')]
    #[On('brand-address-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getAddresses();
    }

    public function delete(BrandAddress $address): void
    {
        $address->delete();

        $this->dispatch('brand-address-deleted');

        $this->getAddresses();
    }

    public function searchResults(string $partial): void
    {
        $this->brandAddresses = BrandAddress::where(function ($query) use ($partial) {
                $query->where('title', 'like', '%' . $partial . '%')
                    ->orWhere('user_id', 'like', '%' . $partial . '%')
                    ->orWhere('brand_id', 'like', '%' . $partial . '%')
                    ->orWhere('building_number', 'like', '%' . $partial . '%')
                    ->orWhere('pre_direction', 'like', '%' . $partial . '%')
                    ->orWhere('street_name', 'like', '%' . $partial . '%')
                    ->orWhere('street_type', 'like', '%' . $partial . '%')
                    ->orWhere('post_direction', 'like', '%' . $partial . '%')
                    ->orWhere('city', 'like', '%' . $partial . '%')
                    ->orWhere('state', 'like', '%' . $partial . '%')
                    ->orWhere('zip', 'like', '%' . $partial . '%')
                    ->orWhere('po_box', 'like', '%' . $partial . '%');
            })
            ->orderBy('title')
            ->get();
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-body">
            <div class="tw-flex tw-justify-between tw-items-center">
                <h1>All addresses</h1>
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
                @if(!empty($brandAddresses[0]))
                    @foreach ($brandAddresses as $address)
                        <div class="tw-p-6 tw-flex tw-space-x-2">
                            <div class="tw-flex-1">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <h1>{{ $address->title }}</h1>
                                    </div>
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link wire:click="edit({{ $address->id }})">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link wire:click="delete({{ $address->id }})" wire:confirm="Are you sure to delete this address?">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                @if ($address->is($editing))
                                    <div class="tw-mt-6">
                                        <livewire:employee.brand-addresses.edit :address="$address" :key="$address->id" :brand="$brand"  />
                                    </div>
                                @else
                                    @if (!empty($address->building_number))
                                        <address>
                                            {{ $address->building_number }}
                                            @if(!empty($address->pre_direction))
                                                {{ $address->pre_direction }}
                                            @endif
                                            {{ $address->street_name }}
                                            {{ $address->street_type }}
                                            @if(!empty($address->post_direction))
                                                {{ $address->post_direction }}
                                            @endif
                                            @if(!empty($address->unit_type))
                                                <br />
                                                {{ $address->unit_type }}
                                                {{ $address->unit }}
                                            @endif
                                            <br />
                                            {{ $address->city }},
                                            {{ $address->state }}
                                            {{ $address->zip }}
                                        </address>
                                    @else
                                        <address>
                                            {{ $address->po_box }}<br />
                                            {{ $address->city }},
                                            {{ $address->state }}
                                            {{ $address->zip }}
                                        </address>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <x-no-data />
                @endif
            </div>
        </div>
    </div>
</div>
