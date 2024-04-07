<?php

use App\Models\PaymentMethod;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    public PaymentMethod $paymentMethod;

    #[Validate('required|string|min:2|max:50|unique:payment_methods,name,NULL,NULL,deleted_at,NULL')]
    public string $name = '';


    public function mount(): void
    {
        $this->name = $this->paymentMethod->name;
    }

    public function updatePaymentMethod()
    {
        if (auth()->user()->can('paymentmethod.edit')) {
            $validated = $this->validate();

            if ($this->paymentMethod->update($validated)) {
                $this->dispatch('payment-method-updated');

                $this->name = '';
            } else {
                $this->dispatch('payment-method-not-updated');
            }
        } else {
            $this->dispatch('unauthorized-action');
        }
    }

    public function cancel(): void
    {
        $this->dispatch('payment-method-edit-canceled');
    }
}; ?>

<div>
    <form wire:submit="updatePaymentMethod" novalidate autocomplete="off">
        <div class="card">
            <div class="card-header">
                <h2>Edit a payment method</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input cols="col-lg-3" id="name" model="name" label="Name" />

                </div>
            </div>
            <div class="card-footer">
                <x-submit-cancel id="payment-terms-create" />
            </div>
        </div>
    </form>
</div>
