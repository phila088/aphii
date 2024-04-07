<?php

use App\Models\PaymentTerm;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required|string|min:2|max:50|unique:payment_terms,name,NULL,NULL,deleted_at,NULL')]
    public string $name = '';
    #[Validate('required|string|min:6|max:6|unique:payment_terms,code,NULL,NULL,deleted_at,NULL')]
    public string $code = '';
    #[Validate('required|integer|min:0')]
    public int $net_days = 0;
    #[Validate('required|integer|min:0')]
    public int $cod_amount = 0;
    #[Validate('required|integer|min:0|max:100')]
    public int $cod_percent = 0;
    #[Validate('required|integer|min:0')]
    public int $net_amount = 0;
    #[Validate('required|integer|min:0|max:100')]
    public int $net_percent = 0;

    public function mount(): void
    {

    }

    public function createPaymentTerm(): void
    {
        if (auth()->user()->can('paymentterm.create')) {
            $validated = $this->validate();

            if (PaymentTerm::create($validated)) {
                $this->dispatch('payment-term-created');

                $this->name = '';
                $this->code = '';
                $this->net_days = 0;
                $this->cod_amount = 0;
                $this->cod_percent = 0;
                $this->net_amount = 0;
                $this->net_percent = 0;
            } else {
                $this->dispatch('payment-term-not-created');
            }
        } else {
            $this->dispatch('unauthorized-action');
        }
    }

    public function codeToUpper(string $code): void
    {
        $this->code = strtoupper($code);
    }
}; ?>

<div>
    <form wire:submit="createPaymentTerm" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Create a payment term</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input cols="col-lg-3" id="name" model="name" label="Name" />

                    <x-input id="code" model="code" label="Code" x-mask="******" x-on:blur="$wire.codeToUpper($el.value)"/>

                    <x-input type="number" step="1" min="0" id="net-days" model="net_days" live="false" label="NET days to pay" />
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h2>COD</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input type="number" step="0.01" min="0" id="cod-amount" model="cod_amount" live="false" label="COD amount" />

                    <x-input type="number" step="1" min="0" max="100" id="cod-percent" model="cod_percent" live="false" label="COD percent" />
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h2>NET</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input type="number" step="0.01" min="0" id="net-amount" model="net_amount" live="false" label="NET amount" />

                    <x-input type="number" step="1" min="0" max="100" id="net-percent" model="net_percent" live="false" label="NET percent" />
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="payment-terms-create" />
            </div>
        </div>
    </form>
</div>
