<?php

use App\Models\PaymentTerm;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $paymentTerms;
    public string $searchTerm = '';

    public ?PaymentTerm $editing = null;

    public function mount(): void
    {
        $this->getPaymentTerms();
    }

    #[On('payment-term-created')]
    public function getPaymentTerms(): void
    {
        if (empty($this->searchTerm)) {
            $this->paymentTerms = PaymentTerm::orderBy('code')
                ->get();
        } else {
            $this->searchResults($this->searchTerm);
        }
    }

    public function edit(PaymentTerm $paymentTerm): void
    {
        $this->editing = $paymentTerm;

        $this->getPaymentTerms();
    }

    #[On('payment-term-edit-canceled')]
    #[On('payment-term-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getPaymentTerms();
    }

    public function delete(PaymentTerm $paymentTerm): void
    {
        if (auth()->user()->can('paymentterm.delete')) {
            $paymentTerm->delete();

            $this->getPaymentTerms();
        }
    }

    public function searchResults(string $partial): void
    {
        if (empty($partial)) {
            $this->getPaymentTerms();
        } else {
            $this->paymentTerms = PaymentTerm::orderBy('code')
                ->where('name', 'like', '%' . $partial . '%')
                ->orWhere('code', 'like', '%' . $partial . '%')
                ->orWhere('net_days', 'like', '%' . $partial . '%')
                ->orWhere('cod_amount', 'like', '%' . $partial . '%')
                ->orWhere('cod_percent', 'like', '%' . $partial . '%')
                ->orWhere('net_amount', 'like', '%' . $partial . '%')
                ->orWhere('net_percent', 'like', '%' . $partial . '%')
                ->get();
        }
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center tw-w-full">
                <h2>All payment terms</h2>
                <div>
                    <input type="text" id="payment-terms-index-search" wire:model="searchTerm" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value)">
                    <label for="payment-terms-index-search" class="tw-sr-only">Search</label>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tw-mt-4 tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700">
                @if ($paymentTerms->isEmpty())
                    <x-no-data />
                @else
                    @foreach ($paymentTerms as $paymentTerm)
                        <div class="tw-p-4 tw-flex tw-space-x-2 hover:tw-bg-gray-100 dark:hover:tw-bg-gray-800" wire:key="{{ $paymentTerm->id }}">
                            <div class="tw-flex-1">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <p class="tw-mt-0.5 tw-text-sm">{{ $paymentTerm->code }}</p>
                                    </div>
                                    @canany (['paymentterm.edit', 'paymentterm.delete'])
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                @can ('paymentterm.edit')
                                                    <x-dropdown-link wire:click="edit({{ $paymentTerm->id }})">
                                                        Edit
                                                    </x-dropdown-link>
                                                @endcan
                                                @can ('paymentterm.delete')
                                                    <x-dropdown-link wire:click="delete({{ $paymentTerm->id }})" wire:confirm="Are you sure you want to delete this payment term?">
                                                        Delete
                                                    </x-dropdown-link>
                                                @endcan
                                            </x-slot>
                                        </x-dropdown>
                                    @endcanany
                                </div>
                                <div class="tw-text-xs">
                                    @if ($paymentTerm->is($editing))
                                        <livewire:admin.payment-terms.edit :paymentTerm="$paymentTerm" wire:key="$paymentTerm->id" />
                                    @else
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    Name:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ $paymentTerm->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    NET days to pay:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ $paymentTerm->net_days }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    COD amount:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Number::currency($paymentTerm->cod_amount) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    COD percent:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Number::percentage($paymentTerm->cod_percent) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    NET amount:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Number::currency($paymentTerm->net_amount) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    NET percent:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Number::percentage($paymentTerm->net_percent) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 col-lg-2 tw-font-bold">
                                                    Created:
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    {{ Carbon::parse($paymentTerm->created_at)->timezone(auth()->user()->timezone)->format('m.d.Y G:i A') }}
                                                    @unless ($paymentTerm->created_at->eq($paymentTerm->updated_at))
                                                        &middot; edited
                                                    @endunless
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
