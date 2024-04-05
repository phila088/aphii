<?php

use App\Models\PaymentMethod;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $paymentMethods;
    public string $searchTerm = '';

    public ?PaymentMethod $editing = null;

    public function mount(): void
    {
        $this->getPaymentMethods();
    }

    #[On('payment-method-created')]
    public function getPaymentMethods(): void
    {
        if (empty($this->searchMethod)) {
            $this->paymentMethods = PaymentMethod::orderBy('name')
                ->get();
        } else {
            $this->searchResults($this->searchMethod);
        }
    }

    public function edit(PaymentMethod $paymentMethod): void
    {
        $this->editing = $paymentMethod;

        $this->getPaymentMethods();
    }

    #[On('payment-method-edit-canceled')]
    #[On('payment-method-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getPaymentMethods();
    }

    public function delete(PaymentMethod $paymentMethod): void
    {
        if (auth()->user()->can('paymentmethod.delete')) {
            $paymentMethod->delete();

            $this->getPaymentMethods();
        }
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getPaymentMethods();
        } else {
            $this->paymentMethods = PaymentMethod::orderBy('name')
                ->where('name', 'like', '%' . $partial . '%')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All payment methods</h2>
                <div>
                    <input type="text" id="payment-methods-index-search" wire:model="searchMethod" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value)">
                    <label for="payment-methods-index-search" class="tw-sr-only">Search</label>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tw-mt-4 tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700">
                @if ($paymentMethods->isEmpty())
                    <x-no-data />
                @else
                    @foreach ($paymentMethods as $paymentMethod)
                        <div class="tw-p-4 tw-flex tw-space-x-2 hover:tw-bg-gray-100 dark:hover:tw-bg-gray-800" wire:key="{{ $paymentMethod->id }}">
                            <div class="tw-flex-1">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <p class="tw-mt-0.5 tw-text-sm">{{ $paymentMethod->name }}</p>
                                    </div>
                                    @canany (['paymentmethod.edit', 'paymentmethod.delete'])
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                @can ('paymentmethod.edit')
                                                    <x-dropdown-link wire:click="edit({{ $paymentMethod->id }})">
                                                        Edit
                                                    </x-dropdown-link>
                                                @endcan
                                                @can ('paymentmethod.delete')
                                                    <x-dropdown-link wire:click="delete({{ $paymentMethod->id }})" wire:confirm="Are you sure you want to delete this payment method?">
                                                        Delete
                                                    </x-dropdown-link>
                                                @endcan
                                            </x-slot>
                                        </x-dropdown>
                                    @endcanany
                                </div>
                                <div class="tw-text-xs">
                                    @if ($paymentMethod->is($editing))
                                        <livewire:admin.payment-methods.edit :paymentMethod="$paymentMethod" wire:key="$paymentMethod->id" />
                                    @else
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    Created:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Carbon::parse($paymentMethod->created_at)->timezone(auth()->user()->timezone)->format('m.d.Y G:i A') }}
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
