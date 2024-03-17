<?php

use App\Models\Client;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Number;
use Illuminate\Support\Carbon;

new class extends Component {
    public ?Client $client;

    public ?string $user_name = null;
    public ?string $payment_term = '';
    public ?string $status = null;
    public $for_brand = null;
    public ?string $legal_name = '';
    public ?string $dba = '';
    public ?string $abbreviation = '';
    public ?string $legal_entity_type = '';
    public ?int $registered_state = null;
    public ?bool $onboarding_started = false;
    public ?string $onboarding_started_date = null;
    public ?bool $onboarding_finished = false;
    public ?string $onboarding_finished_date = null;
    public ?bool $vendor_packet_complete = false;
    public ?string $vendor_packet_complete_date = null;
    public ?bool $certificate_of_insurance_requested = false;
    public ?bool $certificate_of_insurance_provided = false;
    public ?string $certificate_of_insurance_coverage_start_date = null;
    public ?string $certificate_of_insurance_coverage_end_date = null;
    public ?bool $workers_comp_requested = false;
    public ?bool $workers_comp_provided = false;
    public ?string $workers_comp_coverage_start_date = null;
    public ?string $workers_comp_coverage_end_date = null;
    public ?bool $auto_insurance_requested = false;
    public ?bool $auto_insurance_provided = false;
    public ?string $auto_insurance_coverage_start_date = null;
    public ?string $auto_insurance_coverage_end_date = null;
    public ?bool $misc_insurance_requested = false;
    public ?bool $misc_insurance_provided = false;
    public ?string $misc_insurance_coverage_start_date = null;
    public ?string $misc_insurance_coverage_end_date = null;
    public ?bool $accounts_payables_information_verified = false;
    public ?bool $accounts_receivables_information_verified = false;
    public ?string $contract_start_date = null;
    public ?string $contract_end_date = null;
    public ?string $training_materials = '';
    public ?string $ivr_and_onsite_protocol = '';
    public ?float $invoicing_percent_per_invoice = 0;
    public ?float $invoicing_amount_per_invoice = 0;
    public ?float $invoicing_percent_per_month = 0;
    public ?float $invoicing_amount_per_month = 0;
    public ?string $misc_service_charge_1_description = '';
    public ?float $misc_service_charge_1_amount = 0;
    public ?string $misc_service_charge_2_description = '';
    public ?float $misc_service_charge_2_amount = 0;
    public ?string $misc_service_charge_3_description = '';
    public ?float $misc_service_charge_3_amount = 0;
    public ?string $misc_service_charge_4_description = '';
    public ?float $misc_service_charge_4_amount = 0;
    public ?string $misc_service_charge_5_description = '';
    public ?float $misc_service_charge_5_amount = 0;
    public ?string $invoicing_required_document_list = null;
    public ?string $invoicing_instructions = '';
    public ?string $customer_service_phone_1 = '';
    public ?string $customer_service_phone_2 = '';
    public ?string $customer_service_phone_3 = '';
    public ?string $customer_service_phone_4 = '';
    public ?string $customer_service_phone_5 = '';
    public ?string $customer_service_email_1 = '';
    public ?string $customer_service_email_2 = '';
    public ?string $customer_service_email_3 = '';
    public ?string $customer_service_email_4 = '';
    public ?string $customer_service_email_5 = '';
    public ?string $customer_service_fax = '';
    public ?string $invoicing_phone_1 = '';
    public ?string $invoicing_phone_2 = '';
    public ?string $invoicing_phone_3 = '';
    public ?string $invoicing_phone_4 = '';
    public ?string $invoicing_phone_5 = '';
    public ?string $invoicing_email_1 = '';
    public ?string $invoicing_email_2 = '';
    public ?string $invoicing_email_3 = '';
    public ?string $invoicing_email_4 = '';
    public ?string $invoicing_email_5 = '';
    public ?string $invoicing_fax = '';
    public ?string $ivr_phone_1 = '';
    public ?string $ivr_phone_2 = '';
    public ?string $ivr_phone_3 = '';
    public ?string $ivr_phone_4 = '';
    public ?string $ivr_phone_5 = '';
    public ?string $ivr_email_1 = '';
    public ?string $ivr_email_2 = '';
    public ?string $ivr_email_3 = '';
    public ?string $ivr_email_4 = '';
    public ?string $ivr_email_5 = '';
    public ?string $ivr_fax = '';
    public ?string $onsite_phone_1 = '';
    public ?string $onsite_phone_2 = '';
    public ?string $onsite_phone_3 = '';
    public ?string $onsite_phone_4 = '';
    public ?string $onsite_phone_5 = '';
    public ?string $onsite_email_1 = '';
    public ?string $onsite_email_2 = '';
    public ?string $onsite_email_3 = '';
    public ?string $onsite_email_4 = '';
    public ?string $onsite_email_5 = '';
    public ?string $onsite_fax = '';
    public ?string $remittance_phone_1 = '';
    public ?string $remittance_phone_2 = '';
    public ?string $remittance_phone_3 = '';
    public ?string $remittance_phone_4 = '';
    public ?string $remittance_phone_5 = '';
    public ?string $remittance_email_1 = '';
    public ?string $remittance_email_2 = '';
    public ?string $remittance_email_3 = '';
    public ?string $remittance_email_4 = '';
    public ?string $remittance_email_5 = '';
    public ?string $remittance_fax = '';
    public ?bool $active = false;
    public $deleted_at;
    public $created_at;
    public $updated_at;
    public array $rates = [];
    public string $list = '';

    public function mount(): void
    {
        $this->setClient();
    }

    #[On('client-created')]
    #[On('client-updated')]
    #[On('client-updated')]
    public function getClient(): void
    {
        $this->client = Client::where('id', '=', $this->client->id)
            ->limit(1)
            ->firstOrFail();
        $this->setClient();
    }

    public function setClient(): void
    {
        $this->user_name = $this->client->user->name;
        $this->status = $this->client->status;
        $this->legal_name = $this->client->legal_name;
        $this->dba = $this->client->dba;
        $this->abbreviation = $this->client->abbreviation;
        $this->legal_entity_type = $this->client->legal_entity_type;
        $this->registered_state = $this->client->registered_state;
        $this->onboarding_started = $this->client->onboarding_started;
        $this->onboarding_started_date = $this->client->onboarding_started_date;
        $this->onboarding_finished = $this->client->onboarding_finished;
        $this->onboarding_finished_date = $this->client->onboarding_finished_date;
        $this->vendor_packet_complete = $this->client->vendor_packet_complete;
        $this->vendor_packet_complete_date = $this->client->vendor_packet_complete_date;
        $this->certificate_of_insurance_requested = $this->client->certificate_of_insurance_requested;
        $this->certificate_of_insurance_provided = $this->client->certificate_of_insurance_provided;
        $this->certificate_of_insurance_coverage_start_date = $this->client->certificate_of_insurance_coverage_start_date;
        $this->certificate_of_insurance_coverage_end_date = $this->client->certificate_of_insurance_coverage_end_date;
        $this->workers_comp_requested = $this->client->legal_namworkers_comp_requested;
        $this->workers_comp_provided = $this->client->workers_comp_provided;
        $this->workers_comp_coverage_start_date = $this->client->workers_comp_coverage_start_date;
        $this->workers_comp_coverage_end_date = $this->client->workers_comp_coverage_end_date;
        $this->auto_insurance_requested = $this->client->auto_insurance_requested;
        $this->auto_insurance_provided = $this->client->auto_insurance_provided;
        $this->auto_insurance_coverage_start_date = $this->client->auto_insurance_coverage_start_date;
        $this->auto_insurance_coverage_end_date = $this->client->auto_insurance_coverage_end_date;
        $this->misc_insurance_requested = $this->client->misc_insurance_requested;
        $this->misc_insurance_provided = $this->client->mis_insurance_provided;
        $this->misc_insurance_coverage_start_date = $this->client->misc_insurance_coverage_start_date;
        $this->misc_insurance_coverage_end_date = $this->client->misc_insurance_coverage_end_date;
        $this->accounts_payables_information_verified = $this->client->accounts_payables_information_verified;
        $this->accounts_receivables_information_verified = $this->client->accounts_receivables_information_verified;
        $this->contract_start_date = $this->client->contract_start_date;
        $this->contract_end_date = $this->client->contract_end_date;
        $this->training_materials = $this->client->training_materials;
        $this->ivr_and_onsite_protocol = $this->client->ivr_and_onsite_protocol;
        $this->invoicing_percent_per_invoice = $this->client->invoicing_percent_per_invoice;
        $this->invoicing_amount_per_invoice = $this->client->invoicing_amount_per_invoice;
        $this->invoicing_percent_per_month = $this->client->invoicing_percenter_per_month;
        $this->invoicing_amount_per_month = $this->client->invoicing_amount_per_month;
        $this->misc_service_charge_1_description = $this->client->misc_service_charge_1_description;
        $this->misc_service_charge_1_amount = $this->client->misc_service_charge_1_amount;
        $this->misc_service_charge_2_description = $this->client->misc_service_charge_2_description;
        $this->misc_service_charge_2_amount = $this->client->misc_service_charge_2_amount;
        $this->misc_service_charge_3_description = $this->client->misc_service_charge_3_description;
        $this->misc_service_charge_3_amount = $this->client->misc_service_charge_3_amount;
        $this->misc_service_charge_4_description = $this->client->misc_service_charge_4_description;
        $this->misc_service_charge_4_amount = $this->client->misc_service_charge_4_amount;
        $this->misc_service_charge_5_description = $this->client->misc_service_charge_5_description;
        $this->misc_service_charge_5_amount = $this->client->misc_service_charge_5_amount;
        $this->invoicing_required_document_list = $this->client->invoicing_required_document_list;
        $this->invoicing_instructions = $this->client->invoicing_instructions;
        $this->customer_service_phone_1 = $this->client->customer_service_phone_1;
        $this->customer_service_phone_2 = $this->client->customer_service_phone_2;
        $this->customer_service_phone_3 = $this->client->customer_service_phone_3;
        $this->customer_service_phone_4 = $this->client->customer_service_phone_4;
        $this->customer_service_phone_5 = $this->client->customer_service_phone_5;
        $this->customer_service_email_1 = $this->client->customer_service_email_1;
        $this->customer_service_email_2 = $this->client->customer_service_email_2;
        $this->customer_service_email_3 = $this->client->customer_service_email_3;
        $this->customer_service_email_4 = $this->client->customer_service_email_4;
        $this->customer_service_email_5 = $this->client->customer_service_email_5;
        $this->customer_service_fax = $this->client->customer_service_fax;
        $this->invoicing_email_phone_1 = $this->client->invoicing_email_phone_1;
        $this->invoicing_email_phone_2 = $this->client->invoicing_email_phone_2;
        $this->invoicing_email_phone_3 = $this->client->invoicing_email_phone_3;
        $this->invoicing_email_phone_4 = $this->client->invoicing_email_phone_4;
        $this->invoicing_email_phone_5 = $this->client->invoicing_email_phone_5;
        $this->invoicing_email_email_1 = $this->client->invoicing_email_email_1;
        $this->invoicing_email_email_2 = $this->client->invoicing_email_email_2;
        $this->invoicing_email_email_3 = $this->client->invoicing_email_email_3;
        $this->invoicing_email_email_4 = $this->client->invoicing_email_email_4;
        $this->invoicing_email_email_5 = $this->client->invoicing_email_email_5;
        $this->invoicing_email_fax = $this->client->invoicing_email_fax;
        $this->invoicing_fax = $this->client->fax;
        $this->ivr_phone_1 = $this->client->ivr_phone_1;
        $this->ivr_phone_2 = $this->client->ivr_phone_2;
        $this->ivr_phone_3 = $this->client->ivr_phone_3;
        $this->ivr_phone_4 = $this->client->ivr_phone_4;
        $this->ivr_phone_5 = $this->client->ivr_phone_5;
        $this->ivr_email_1 = $this->client->ivr_email_1;
        $this->ivr_email_2 = $this->client->ivr_email_2;
        $this->ivr_email_3 = $this->client->ivr_email_3;
        $this->ivr_email_4 = $this->client->ivr_email_4;
        $this->ivr_email_5 = $this->client->ivr_email_5;
        $this->ivr_fax = $this->client->ivr_fax;
        $this->onsite_phone_1 = $this->client->onsite_phone_1;
        $this->onsite_phone_2 = $this->client->onsite_phone_2;
        $this->onsite_phone_3 = $this->client->onsite_phone_3;
        $this->onsite_phone_4 = $this->client->onsite_phone_4;
        $this->onsite_phone_5 = $this->client->onsite_phone_5;
        $this->onsite_email_1 = $this->client->onsite_email_1;
        $this->onsite_email_2 = $this->client->onsite_email_2;
        $this->onsite_email_3 = $this->client->onsite_email_3;
        $this->onsite_email_4 = $this->client->onsite_email_4;
        $this->onsite_email_5 = $this->client->onsite_email_5;
        $this->onsite_fax = $this->client->onsite_fax;
        $this->remittance_phone_1 = $this->client->remittance_phone_1;
        $this->remittance_phone_2 = $this->client->remittance_phone_2;
        $this->remittance_phone_3 = $this->client->remittance_phone_3;
        $this->remittance_phone_4 = $this->client->remittance_phone_4;
        $this->remittance_phone_5 = $this->client->remittance_phone_5;
        $this->remittance_email_1 = $this->client->remittance_email_1;
        $this->remittance_email_2 = $this->client->remittance_email_2;
        $this->remittance_email_3 = $this->client->remittance_email_3;
        $this->remittance_email_4 = $this->client->remittance_email_4;
        $this->remittance_email_5 = $this->client->remittance_email_5;
        $this->remittance_fax = $this->client->remittance_fax;
        $this->active = $this->client->active;
        $this->deleted_at = $this->client->deleted_at;
        $this->created_at = $this->client->created_at;
        $this->updated_at = $this->client->updated_at;

        if (!empty($this->client->brand)) {
            $this->for_brand = $this->client->brand->legal_name;
        } else
        {
            $this->for_brand = '';
        }

        if (!is_null($this->onboarding_started_date))
        {
            $date = new Carbon($this->onboarding_started_date);
            $this->onboarding_started_date = $date->format('m/d/Y');
        } else
        {
            $this->onboarding_started_date = '';
        }

        if (!is_null($this->onboarding_finished_date))
        {
            $date = new Carbon($this->onboarding_finished_date);
            $this->onboarding_finished_date = $date->format('m/d/Y');
        }

        if (empty($this->client->paymentTerm))
        {
            $this->payment_term = 'NA - NA';
        } else {
            $this->payment_term = $this->client->paymentTerm->code . ' - ' . $this->client->paymentTerm->title;
        }

        if (!empty($this->client->clientRate[0]))
        {
            $i = 1;
            foreach ($this->client->clientRate as $rate)
            {
                $this->rates[$i]['title'] = (!empty($rate->title)) ? $rate->title : 'Rate ' . $i;
                $this->rates[$i]['default'] = $rate->default;
                $this->rates[$i]['standard_assessment'] = (!is_null($rate->standard_assessment)) ? $rate->standard_assessment : 0;
                $this->rates[$i]['emergency_assessment'] = (!is_null($rate->emergency_assessment)) ? $rate->emergency_assessment : 0;
                $this->rates[$i]['overtime_assessment'] = (!is_null($rate->overtime_assessment)) ? $rate->overtime_assessment : 0;
                $this->rates[$i]['saturday_assessment'] = (!is_null($rate->saturday_assessment)) ? $rate->saturday_assessment : 0;
                $this->rates[$i]['sunday_assessment'] = (!is_null($rate->sunday_assessment)) ? $rate->sunday_assessment : 0;
                $this->rates[$i]['holiday_assessment'] = (!is_null($rate->holiday_assessment)) ? $rate->holiday_assessment : 0;
                $this->rates[$i]['standard_trip'] = (!is_null($rate->standard_trip)) ? $rate->standard_trip : 0;
                $this->rates[$i]['standard_hour'] = (!is_null($rate->standard_hour)) ? $rate->standard_hour : 0;
                $this->rates[$i]['emergency_trip'] = (!is_null($rate->emergency_trip)) ? $rate->emergency_trip : 0;
                $this->rates[$i]['emergency_hour'] = (!is_null($rate->emergency_hour)) ? $rate->emergency_hour : 0;
                $this->rates[$i]['overtime_trip'] = (!is_null($rate->overtime_trip)) ? $rate->overtime_trip : 0;
                $this->rates[$i]['overtime_hour'] = (!is_null($rate->overtime_hour)) ? $rate->overtime_hour : 0;
                $this->rates[$i]['saturday_trip'] = (!is_null($rate->saturday_trip)) ? $rate->saturday_trip : 0;
                $this->rates[$i]['saturday_hour'] = (!is_null($rate->saturday_hour)) ? $rate->saturday_hour : 0;
                $this->rates[$i]['sunday_trip'] = (!is_null($rate->sunday_trip)) ? $rate->sunday_trip : 0;
                $this->rates[$i]['sunday_hour'] = (!is_null($rate->sunday_hour)) ? $rate->sunday_hour : 0;
                $this->rates[$i]['holiday_trip'] = (!is_null($rate->holiday_trip)) ? $rate->holiday_trip : 0;
                $this->rates[$i]['holiday_hour'] = (!is_null($rate->holiday_hour)) ? $rate->holiday_hour : 0;
                $i++;
            }
        }

        if (!is_null($this->deleted_at))
        {
            $this->deleted_at = $this->deleted_at->format('Y-m-d h:m:s');
        }

        if (!is_null($this->created_at))
        {
            $this->created_at = $this->created_at->format('Y-m-d h:m:s');
        }

        if (!is_null($this->updated_at))
        {
            $this->updated_at = $this->updated_at->format('Y-m-d h:m:s');
        }

        $tags = json_decode($this->client->invoicing_required_document_list);
        if (!empty($tags[0])) {
            $this->list = '<ul class="list-group">';
            foreach ($tags as $tag) {
                $this->list .= '<li class="list-group-item">' . $tag->value . '</li>';
            }
            $this->list .= '</ul>';
        }
    }
}; ?>

<div>
    <div class="tw-w-full tw-mx-auto">
        <div class="row tw-mb-4">
            <div class="col-md-2">
                <div class="form-floating">
                    <div class="tw-border-0 form-control">
                        {{ $for_brand }}
                    </div>
                    <label>{{ __('Brand') }}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <div class="tw-border-0 form-control">
                        {{ $legal_name }}
                    </div>
                    <label>{{ __('Name') }}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <div class="tw-border-0 form-control">
                        {{ $dba }}
                    </div>
                    <label>{{ __('DBA') }}</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <div class="tw-border-0 form-control">
                        {{ $abbreviation }}
                    </div>
                    <label>{{ __('Abbreviation') }}</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <div class="tw-border-0 form-control">
                        {{ $status }}
                    </div>
                    <label>{{ __('Status') }}</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tw-py-8">
                <hr class="tw-border-gray-400"/>
            </div>
        </div>
        <div class="row">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" wire:ignore>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-onboarding-tab" data-bs-toggle="pill" data-bs-target="#pills-onboarding" type="button" role="tab" aria-controls="pills-onboarding" aria-selected="true">
                        {{ __('Onboarding') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contract-tab" data-bs-toggle="pill" data-bs-target="#pills-contract" type="button" role="tab" aria-controls="pills-contract" aria-selected="false">
                        {{ __('Contract') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-insurance-tab" data-bs-toggle="pill" data-bs-target="#pills-insurance" type="button" role="tab" aria-controls="pills-insurance" aria-selected="false">
                        {{ __('Insurance') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-monies-tab" data-bs-toggle="pill" data-bs-target="#pills-monies" type="button" role="tab" aria-controls="pills-monies" aria-selected="false">
                        {{ __('Charges & Rates') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill" data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents" aria-selected="false">
                        {{ __('Documents') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contacts-tab" data-bs-toggle="pill" data-bs-target="#pills-contacts" type="button" role="tab" aria-controls="pills-contacts" aria-selected="false">
                        {{ __('Contacts') }}
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-onboarding" role="tabpanel" aria-labelledby="pills-onboarding-tab" tabindex="0">
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="onboarding-started"
                                    name="onboarding-started"
                                    wire:model="onboarding_started"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round"><polyline
                                    points="20 6 9 17 4 12"/></svg>
                        </span>
                            </div>
                            <label for="onboarding-started" class="tw-ps-2">{{ __('Onboarding started') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $onboarding_started_date }}
                                </div>
                                <label>{{ __('Date') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="onboarding-finished"
                                    name="onboarding-finished"
                                    wire:model="onboarding_finished"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round"><polyline
                                    points="20 6 9 17 4 12"/></svg>
                        </span>
                            </div>
                            <label for="onboarding-finished" class="tw-ps-2">{{ __('Onboarding finished') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $onboarding_finished_date }}
                                </div>
                                <label>{{ __('Date') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contract" role="tabpanel" aria-labelledby="pills-contract-tab" tabindex="0">
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="accounts-payables-information-verified"
                                    name="accounts-payables-information-verified"
                                    wire:model="accounts_payables_information_verified"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round"><polyline
                                    points="20 6 9 17 4 12"/></svg>
                        </span>
                            </div>
                            <label for="accounts-payables-information-verified" class="tw-ps-2">{{ __('AP verified') }}</label>
                        </div>
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="accounts-receivables-information-verified"
                                    name="accounts-receivables-information-verified"
                                    wire:model="accounts_receivables_information_verified"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                            <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round"><polyline
                                    points="20 6 9 17 4 12"/></svg>
                        </span>
                            </div>
                            <label for="accounts-receivables-information-verified" class="tw-ps-2">{{ __('AR verified') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    Not Available
                                </div>
                                <label>{{ __('Contract documents') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->paymentTerm->code }} - {{ $client->paymentTerm->title }}
                                </div>
                                <label>{{ __('Payment term') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->contract_start_date }}
                                </div>
                                <label>{{ __('Start date') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->contract_end_date }}
                                </div>
                                <label>{{ __('End date') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="vendor-packet-complete"
                                    name="vendor-packet-complete"
                                    wire:model="vendor_packet_complete"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="vendor-packet-complete" class="tw-ps-2">{{ __('Vendor packet complete') }}</label>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-insurance" role="tabpanel" aria-labelledby="pills-insurance-tab" tabindex="0">
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="certificate-of-insurance-requested"
                                    name="certificate-of-insurance-requested"
                                    wire:model="certificate_of_insurance_requested"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="certificate-of-insurance-requested" class="tw-ps-2">{{ __('COI requested') }}</label>
                        </div>
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="certificate-of-insurance-provided"
                                    name="certificate-of-insurance-provided"
                                    wire:model="certificate_of_insurance_provided"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="certificate-of-insurance-provided" class="tw-ps-2">{{ __('COI provided') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->certificate_of_insurance_coverage_start_date }}
                                </div>
                                <label>{{ __('Start date') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->certificate_of_insurance_coverage_end_date }}
                                </div>
                                <label>{{ __('End date') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="workers-comp-requested"
                                    name="workers-comp-requested"
                                    wire:model="workers_comp_requested"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="workers-comp-requested" class="tw-ps-2">{{ __('Workers comp requested') }}</label>
                        </div>
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="workers-comp-provided"
                                    name="workers-comp-provided"
                                    wire:model="workers_comp_provided"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="workers-comp-provided" class="tw-ps-2">{{ __('Workers comp provided') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->workers_comp_coverage_start_date }}
                                </div>
                                <label>{{ __('Start date') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->workers_comp_coverage_end_date }}
                                </div>
                                <label>{{ __('End date') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="auto-insurance-requested"
                                    name="auto-insurance-requested"
                                    wire:model="auto_insurance_requested"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="auto-insurance-requested" class="tw-ps-2">{{ __('Auto requested') }}</label>
                        </div>
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="auto-insurance-provided"
                                    name="auto-insurance-provided"
                                    wire:model="auto_insurance_provided"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="auto-insurance-provided" class="tw-ps-2">{{ __('Auto provided') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->auto_insurance_coverage_start_date }}
                                </div>
                                <label>{{ __('Start date') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->auto_insurance_coverage_end_date }}
                                </div>
                                <label>{{ __('End date') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row tw-mx-8 tw-my-6">
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="misc-insurance-requested"
                                    name="misc-insurance-requested"
                                    wire:model="misc_insurance_requested"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="misc-insurance-requested" class="tw-ps-2">{{ __('Misc requested') }}</label>
                        </div>
                        <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                            <div class="tw-relative tw-inline-block">
                                <input
                                    type="checkbox"
                                    id="misc-insurance-provided"
                                    name="misc-insurance-provided"
                                    wire:model="workers_comp_provided"
                                    class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
                                    disabled
                                >
                                <span
                                    class="peer-checked:tw-text-white tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-start-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                    <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="m6 6 12 12"/>
                                    </svg>
                            </span>
                                <span
                                    class="peer-checked:tw-text-blue-600 tw-text-gray-500 tw-size-5 tw-absolute tw-top-[3px] tw-end-0.5 tw-flex tw-justify-center tw-items-center tw-pointer-events-none tw-transition-colors tw-ease-in-out tw-duration-200">
                                <svg class="tw-flex-shrink-0 tw-size-3" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     stroke-linecap="round" stroke-linejoin="round"><polyline
                                        points="20 6 9 17 4 12"/></svg>
                            </span>
                            </div>
                            <label for="misc-insurance-provided" class="tw-ps-2">{{ __('Misc provided') }}</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->misc_insurance_coverage_start_date }}
                                </div>
                                <label>{{ __('Start date') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <div class="tw-border-0 form-control">
                                    {{ $client->misc_insurance_coverage_end_date }}
                                </div>
                                <label>{{ __('End date') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-monies" role="tabpanel" aria-labelledby="pills-monies-tab" tabindex="0">
                    <div class="row tw-mx-8 tw-my-6">
                        @if (!empty($this->rates))
                            @foreach ($this->rates as $rate)
                                <div class="row tw-mb-4">
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <div class="tw-border-0 form-control">
                                                {{ Number::currency($rate['standard_assessment']) }}
                                            </div>
                                            <label>{{ __('Standard assessment') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <div class="tw-border-0 form-control">
                                                {{ Number::currency($rate['emergency_assessment']) }}
                                            </div>
                                            <label>{{ __('Emergency assessment') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <div class="tw-border-0 form-control">
                                                {{ Number::currency($rate['overtime_assessment']) }}
                                            </div>
                                            <label>{{ __('Overtime assessment') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <div class="tw-border-0 form-control">
                                                {{ Number::currency($rate['saturday_assessment']) }}
                                            </div>
                                            <label>{{ __('Saturday assessment') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <div class="tw-border-0 form-control">
                                                {{ Number::currency($rate['sunday_assessment']) }}
                                            </div>
                                            <label>{{ __('Sunday assessment') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <div class="tw-border-0 form-control">
                                                {{ Number::currency($rate['holiday_assessment']) }}
                                            </div>
                                            <label>{{ __('Holiday assessment') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row tw-mb-4">
                                    <div class="col-md-2">
                                        <h4 class="tw-text-center tw-mb-2">{{ __('Regular rates') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['standard_trip']) }}
                                                    </div>
                                                    <label>Trip</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['standard_hour']) }}
                                                    </div>
                                                    <label>{{ __('Hour') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="tw-text-center tw-mb-2">{{ __('Emergency rates') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['emergency_trip']) }}
                                                    </div>
                                                    <label>{{ __('Trip') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['emergency_hour']) }}
                                                    </div>
                                                    <label>{{ __('Hour') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="tw-text-center tw-mb-2">{{ __('Overtime rates') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['overtime_trip']) }}
                                                    </div>
                                                    <label>{{ __('Trip') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['overtime_hour']) }}
                                                    </div>
                                                    <label>{{ __('Hour') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="tw-text-center tw-mb-2">{{ __('Saturday rates') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['saturday_trip']) }}
                                                    </div>
                                                    <label>{{ __('Trip') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['saturday_hour']) }}
                                                    </div>
                                                    <label>{{ __('Hour') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="tw-text-center tw-mb-2">{{ __('Sunday rates') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['sunday_trip']) }}
                                                    </div>
                                                    <label>{{ __('Trip') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['sunday_hour']) }}
                                                    </div>
                                                    <label>{{ __('Hour') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="tw-text-center tw-mb-2">{{ __('Holiday rates') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['holiday_trip']) }}
                                                    </div>
                                                    <label>{{ __('Trip') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="tw-border-0 form-control">
                                                        {{ Number::currency($rate['holiday_hour']) }}
                                                    </div>
                                                    <label>{{ __('Hour') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row tw-mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::percentage($client->invoicing_percent_per_invoice) }}
                                    </div>
                                    <label>{{ __('Percent per invoice') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($client->invoicing_amount_per_invoice) }}
                                    </div>
                                    <label>{{ __('Amount per invoice') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::percentage($client->invoicing_percent_per_month) }}
                                    </div>
                                    <label>{{ __('Percenter per month') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($client->invoicing_amount_per_month) }}
                                    </div>
                                    <label>{{ __('Amount per month') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row tw-mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ $client->misc_service_charge_1_description }}
                                    </div>
                                    <label>{{ __('Misc service charge description') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($misc_service_charge_1_amount) }}
                                    </div>
                                    <label>{{ __('Misc service charge amount') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ $misc_service_charge_2_description }}
                                    </div>
                                    <label>{{ __('Misc service charge description') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($misc_service_charge_2_amount) }}
                                    </div>
                                    <label>{{ __('Misc service charge amount') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ $misc_service_charge_3_description }}
                                    </div>
                                    <label>{{ __('Misc service charge description') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($misc_service_charge_3_amount) }}
                                    </div>
                                    <label>{{ __('Misc service charge amount') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row tw-mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ $misc_service_charge_4_description }}
                                    </div>
                                    <label>{{ __('Misc service charge description') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($misc_service_charge_4_amount) }}
                                    </div>
                                    <label>{{ __('Misc service charge amount') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ $misc_service_charge_5_description }}
                                    </div>
                                    <label>{{ __('Misc service charge description') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <div class="tw-border-0 form-control">
                                        {{ Number::currency($misc_service_charge_5_amount) }}
                                    </div>
                                    <label>{{ __('Misc service charge amount') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab" tabindex="0">
                    <style>
                    div[id='pills-documents'] li {
                    list-style:inside;
                    }
                    </style>
                    <div class="row tw-my-6">
                        <div class="tw-w-2/3 tw-mx-auto">
                            {!! $training_materials !!}
                        </div>
                    </div>
                    <div class="row tw-mb-6">
                        <div class="tw-w-2/3 tw-mx-auto">
                            {!! $ivr_and_onsite_protocol !!}
                        </div>
                    </div>
                    <div class="row tw-mb-6">
                        <div class="tw-w-2/3 tw-mx-auto">
                            {!! $invoicing_instructions !!}
                        </div>
                    </div>
                    <div class="row tw-mb-6">
                        <div class="tw-w-1/4 tw-mx-auto">
                            {!! $list !!}
                        </div>
                    </div>
                    <div class="row tw-mb-6">
                        <hr class="border-gray-200">
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contacts" role="tabpanel" aria-labelledby="pills-contacts-tab" tabindex="0">...</div>
            </div>
            <div class="row tw-my-6">
                <div class="col-md-2">
                    <div class="form-floating">
                        <div class="form-control">
                            {{ $client->user->name }}
                        </div>
                        <label>{{ __('') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <div class="tw-border-0 form-control">
                            {{ $client->deleted_at }}
                        </div>
                        <label >Deleted at</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="created-at"
                            id="created-at"
                            wire:model="created_at"
                            class="form-control"
                            placeholder="Created At"
                            readonly
                        >
                        <label for="floatingInput">Created At</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="updated-at"
                            id="updated-at"
                            wire:model="updated_at"
                            class="form-control"
                            placeholder="Updated At"
                            readonly
                        >
                        <label for="floatingInput">Updated At</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

