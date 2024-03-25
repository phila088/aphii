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
}; ?>

<div class="tw-mt-6 tw-bg-white tw-shadow-sm tw-rounded-lg tw-divide-y">
    <div class="row g-2 border-0">
        <div class="row g-2">
            <h1 class="tw-text-md">View all addresses</h1>
        </div>

        <div class="row g-2">
            @if(!empty($brandAddresses[0]))
                @foreach ($brandAddresses as $address)
                    <div class="tw-p-6 tw-flex tw-space-x-2">
                        <div class="tw-flex-1">
                            <div class="tw-flex tw-justify-between tw-items-center">
                                <div>
                                    <span class="tw-text-gray-800">{{ $address->user->name }}</span>
                                    <small class="tw-ml-2 tw-text-xs tw-text-gray-600">{{ $address->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($address->created_at->eq($address->updated_at))
                                        <small class="tw-text-xs tw-text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
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
                                <livewire:employee.brand-addresses.edit :address="$address" :key="$address->id" :brand="$brand"  />
                            @else
                                <p class="tw-mt-4 tw-text-lg tw-text-gray-900">{{ $address->title }}</p>
                                @if (!empty($address->building_number))
                                    <p class="tw-mt-4 tw-text-md tw-text-gray-900">
                                        {{ $address->building_number }}
                                        @if(!empty($address->pre_direction))
                                            {{ $address->pre_direction }}
                                        @endif
                                        {{ $address->street_name }}
                                        {{ $address->street_type }}
                                        @if(!empty($address->post_direction))
                                            {{ $address->post_direction }}
                                        @endif
                                        {{ $address->city }},
                                        {{ $address->state }}
                                        {{ $address->zip }}
                                    </p>
                                @else
                                    <p class="tw-mt-4 tw-text-md tw-text-gray-900">
                                        {{ $address->po_box }}
                                        {{ $address->city }},
                                        {{ $address->state }}
                                        {{ $address->zip }}
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="tw-min-h-60 tw-flex tw-flex-col tw-border tw-shadow-sm tw-rounded-xl dark:tw-border-gray-700 dark:tw-shadow-slate-700/[.7]">
                    <div class="tw-flex tw-flex-auto tw-flex-col tw-justify-center tw-items-center tw-p-4 tw-md:p-5">
                        <svg class="tw-size-10 tw-text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" x2="2" y1="12" y2="12"/>
                            <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
                            <line x1="6" x2="6.01" y1="16" y2="16"/>
                            <line x1="10" x2="10.01" y1="16" y2="16"/>
                        </svg>
                        <p class="tw-mt-5 tw-text-sm tw-text-gray-800 dark:tw-text-gray-300">
                            No data to show
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
