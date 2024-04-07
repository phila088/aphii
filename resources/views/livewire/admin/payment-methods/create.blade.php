<?php

use App\Models\PaymentMethod;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required|string|min:2|max:50|unique:payment_methods,name,NULL,NULL,deleted_at,NULL')]
    public string $name = '';

    public function mount(): void
    {

    }

    public function createPaymentMethod(): void
    {
        if (auth()->user()->can('paymentmethod.create')) {
             $validated = $this->validate();

             if (PaymentMethod::create($validated)) {
                 $this->dispatch('payment-method-created');

                 $this->name = '';
             } else {
                 $this->dispatch('payment-method-not-created');
             }
        } else {
            $this->dispatch('unauthorized-action');
        }
    }
}; ?>

<div>
    <form wire:submit="createPaymentMethod" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Create a payment term</h2>
            </div>
            <div class="card-body">
                <x-input cols="col-lg-12" id="name" model="name" label="Name" />
            </div>
            <div class="card-footer">
                <x-submit id="payment-method-create" />
            </div>
        </div>
    </form>
</div>
