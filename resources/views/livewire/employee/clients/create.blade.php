<?php

use App\Models\Client;
use App\Models\StatusCode;
use App\Models\PaymentTerm;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;

new class extends Component {
    public Collection $statusCodes;
    public Collection $paymentTerms;

    #[Validate('required|string|exists:status_codes,code')]
    public string $status_code = '';
    #[Validate('nullable|string')]
    public string $status_reason = '';
    #[Validate('required|string|min:2|max:50')]
    public string $name;
    #[Validate('nullable|string|min:2|max:50')]
    public string $dba;
    #[Validate('required|string|min:2|max:10')]
    public string $abbreviation;
    #[Validate('nullable|boolean')]
    public bool $onboarding_started;
    #[Validate('nullable|date')]
    public string $onboarding_started_date;
    #[Validate('nullable|boolean')]
    public bool $onboarding_finished;
    #[Validate('nullable|date')]
    public string $onboarding_finished_date;
    #[Validate('nullable|date')]
    public string $contract_start_date;
    #[Validate('nullable|date')]
    public string $contract_end_date;
    #[Validate('nullable|string|exists:payment_terms,id')]
    public string $payment_term_id;

    public function mount(): void
    {
        $this->getStatusCodes();
        $this->getPaymentTerms();
    }

    public function store(): void
    {
        $this->authorize('clients.create');

        $statusCodes = [];
        foreach ($this->statusCodes as $v) {
            $statusCodes[] = $v->code;
        }

        $paymentTerms = [];
        foreach ($this->paymentTerms as $v) {
            $paymentTerms[] = $v->id;
        }

        $validated = $this->validate();

        if ($client = auth()->user()->client()->create($validated)) {
            $client->setStatus($this->status_code, $this->status_reason);
        }
    }

    public function getStatusCodes(): void
    {
        $this->statusCodes = StatusCode::where('for_model', 'Client')
            ->get();
    }

    public function changeStatusReason(): void
    {
        if (!empty($this->status_code)) {
            if (empty($this->status_reason)) {
                $selected = $this->statusCodes->firstWhere('code', $this->status_code);

                if (!is_null($selected)) {
                    $this->status_reason = $selected->default_reason;
                }
            }
        } else {
            $this->status_reason = '';
        }
    }

    public function getPaymentTerms(): void
    {
        $this->paymentTerms = PaymentTerm::get();
    }
}; ?>

<div>
    <form wire:submit="store">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Status</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="status-code">Status</label>
                            <select id="status-code" wire:model="status_code" class="form-select" wire:change="changeStatusReason">
                                <option></option>
                                @foreach ($statusCodes as $statusCode)
                                    <option value="{{ $statusCode->code }}">{{ $statusCode->code }} - {{ $statusCode->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('status_code')" class="tw-text-xs tw-text-red-500 mt-2"/>
                    </div>

                    <x-input cols="col-lg-10" id="status-reason" model="status_reason" label="Status reason" />
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h2>Name</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input cols="col-lg-3" id="name" model="name" label="Name" />

                    <x-input cols="col-lg-3" id="dba" model="dba" label="DBA" />

                    <x-input id="abbreviation" model="abbreviation" label="Abbreviation" />
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h2>Onboarding</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-auto d-flex align-items-center">
                        <div class="custom-toggle-switch d-flex align-items-center">
                            <input id="onboarding-started" wire:model="onboarding_started" type="checkbox" />
                            <label for="onboarding-started" class="label-primary"></label>
                            <span class="ms-3">Onboarding started</span>
                        </div>
                    </div>

                    <x-input type="date" id="onboarding-started-date" model="onboarding_started_date" label="Onboarding started date" />

                    <div class="col-lg-auto d-flex align-items-center">
                        <div class="custom-toggle-switch d-flex align-items-center">
                            <input id="onboarding-finished" wire:model="onboarding_finished" type="checkbox" />
                            <label for="onboarding-finished" class="label-primary"></label>
                            <span class="ms-3">Onboarding finished</span>
                        </div>
                    </div>

                    <x-input type="date" id="onboarding-finished-date" model="onboarding_finished_date" label="Onboarding finished date" />
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h2>Contract</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-input type="date" id="contract-start-date" model="contract_start_date" label="Contract start date" />

                    <x-input type="date" id="contract-end-date" model="contract_end_date" label="Contract end date" />

                    <x-select id="payment-term-id" model="payment_term_id" label="Payment terms">
                        <option></option>
                        @foreach ($paymentTerms as $paymentTerm)
                            <option value="{{ $paymentTerm->id }}">{{ $paymentTerm->code }} - {{ $paymentTerm->name }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="client-create" />
            </div>
        </div>
    </form>
</div>
