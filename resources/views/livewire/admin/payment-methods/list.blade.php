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
            @can('paymentMethods.viewAny')
                @if ($paymentMethods->isEmpty())
                    <x-no-data />
                @else
                    <ul class="list-group">
                        @foreach ($paymentMethods as $paymentMethod)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    {{ $paymentMethod->name }}
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $paymentMethod->id }})"><i class="bi bi-pencil"></i></button>
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $paymentMethod->id }})"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                @if ($paymentMethod->is($editing))
                                    <livewire:admin.payment-methods.edit :paymentMethod="$paymentMethod" wire:key="$paymentMethod->id" />
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            @else
                <x-not-auth />
            @endcan
        </div>
    </div>
</div>
