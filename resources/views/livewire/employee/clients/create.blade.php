<?php

use App\Models\PotentialClient;
use App\Models\Client;
use App\Models\Brand;
use App\Models\States;
use App\Models\PaymentTerm;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;

new class extends Component {
    public Collection $potentialClients;
    public Collection $clients;
    public ?int $client_id = null;
    public ?Collection $copyClient = null;
    public ?Collection $brands = null;
    public ?Collection $states = null;
    public ?Collection $payment_terms = null;

    public ?int $potential_client_id = null;
    public ?int $payment_term_id = null;
    public ?int $for_brand = null;
    #[Validate('required|string|min:5|max:50')]
    public ?string $legal_name = '';
    #[Validate('nullable|string|min:5|max:50')]
    public ?string $dba = '';
    #[Validate('required|string|min:1|max:10')]
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

    public function mount(): void
    {
        $this->getPotentialClients();
        $this->getClients();
        $this->getBrands();
        $this->getStates();
        $this->getPaymentTerms();
    }

public function store()
    {
        $validated = $this->validate([
            'potential_client_id' => ['nullable', 'exists:potential_clients'],
            'payment_term_id' => ['nullable', 'exists:payment_terms'],
            'for_brand' => ['nullable', 'exists:brands'],
            'legal_name' => ['required', 'string', 'min:5', 'max:50'],
            'dba' => ['nullable', 'string', 'min:5', 'max:50'],
            'abbreviation' => ['required', 'string', 'min:1', 'max:10'],
            'legal_entity_type' => ['nullable'],
            'registered_state' => ['nullable'],
            'onboarding_started' => ['nullable', 'boolean'],
            'onboarding_started_date' => ['nullable', 'date'],
            'onboarding_finished' => ['nullable', 'boolean'],
            'onboarding_finished_date' => ['nullable', 'date'],
            'vendor_packet_complete' => ['nullable', 'boolean'],
            'vendor_packet_complete_date' => ['nullable', 'date'],
            'certificate_of_insurance_requested' => ['nullable', 'boolean'],
            'certificate_of_insurance_provided' => ['nullable', 'boolean'],
            'certificate_of_insurance_coverage_start_date' => ['nullable', 'date'],
            'certificate_of_insurance_coverage_end_date' => ['nullable', 'date'],
            'workers_comp_requested' => ['nullable', 'boolean'],
            'workers_comp_provided' => ['nullable', 'boolean'],
            'workers_comp_coverage_start_date' => ['nullable', 'date'],
            'workers_comp_coverage_end_date' => ['nullable', 'date'],
            'auto_insurance_requested' => ['nullable', 'boolean'],
            'auto_insurance_provided' => ['nullable', 'boolean'],
            'auto_insurance_coverage_start_date' => ['nullable', 'date'],
            'auto_insurance_coverage_end_date' => ['nullable', 'date'],
            'misc_insurance_requested' => ['nullable', 'boolean'],
            'misc_insurance_provided' => ['nullable', 'boolean'],
            'misc_insurance_coverage_start_date' => ['nullable', 'date'],
            'misc_insurance_coverage_end_date' => ['nullable', 'date'],
            'accounts_payables_information_verified' => ['nullable', 'boolean'],
            'accounts_receivables_information_verified' => ['nullable', 'boolean'],
            'contract_start_date' => ['nullable', 'date'],
            'contract_end_date' => ['nullable', 'date'],
            'training_materials' => ['nullable', 'string'],
            'ivr_and_onsite_protocol' => ['nullable', 'string'],
            'invoicing_percent_per_invoice' => ['nullable', 'decimal:0,4'],
            'invoicing_amount_per_invoice' => ['nullable', 'decimal:0,4'],
            'invoicing_percent_per_month' => ['nullable', 'decimal:0,4'],
            'invoicing_amount_per_month' => ['nullable', 'decimal:0,4'],
            'misc_service_charge_1_description' => ['nullable', 'string', 'max:50'],
            'misc_service_charge_1_amount' => ['nullable', 'decimal:0,4'],
            'misc_service_charge_2_description' => ['nullable', 'string', 'max:50'],
            'misc_service_charge_2_amount' => ['nullable', 'decimal:0,4'],
            'misc_service_charge_3_description' => ['nullable', 'string', 'max:50'],
            'misc_service_charge_3_amount' => ['nullable', 'decimal:0,4'],
            'misc_service_charge_4_description' => ['nullable', 'string', 'max:50'],
            'misc_service_charge_4_amount' => ['nullable', 'decimal:0,4'],
            'misc_service_charge_5_description' => ['nullable', 'string', 'max:50'],
            'misc_service_charge_5_amount' => ['nullable', 'decimal:0,4'],
            'invoicing_required_document_list' => ['nullable', 'json'],
            'invoicing_instructions' => ['nullable', 'string'],
            'customer_service_phone_1' => ['nullable', 'string', 'min:10', 'min:12'],
            'customer_service_phone_2' => ['nullable', 'string', 'min:10', 'min:12'],
            'customer_service_phone_3' => ['nullable', 'string', 'min:10', 'min:12'],
            'customer_service_phone_4' => ['nullable', 'string', 'min:10', 'min:12'],
            'customer_service_phone_5' => ['nullable', 'string', 'min:10', 'min:12'],
            'customer_service_email_1' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'customer_service_email_2' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'customer_service_email_3' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'customer_service_email_4' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'customer_service_email_5' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'customer_service_fax' => ['nullable', 'string', 'min:10', 'min:12'],
            'invoicing_phone_1' => ['nullable', 'string', 'min:10', 'min:12'],
            'invoicing_phone_2' => ['nullable', 'string', 'min:10', 'min:12'],
            'invoicing_phone_3' => ['nullable', 'string', 'min:10', 'min:12'],
            'invoicing_phone_4' => ['nullable', 'string', 'min:10', 'min:12'],
            'invoicing_phone_5' => ['nullable', 'string', 'min:10', 'min:12'],
            'invoicing_email_1' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'invoicing_email_2' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'invoicing_email_3' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'invoicing_email_4' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'invoicing_email_5' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'invoicing_fax' => ['nullable', 'string', 'min:10', 'min:12'],
            'ivr_phone_1' => ['nullable', 'string', 'min:10', 'min:12'],
            'ivr_phone_2' => ['nullable', 'string', 'min:10', 'min:12'],
            'ivr_phone_3' => ['nullable', 'string', 'min:10', 'min:12'],
            'ivr_phone_4' => ['nullable', 'string', 'min:10', 'min:12'],
            'ivr_phone_5' => ['nullable', 'string', 'min:10', 'min:12'],
            'ivr_email_1' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'ivr_email_2' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'ivr_email_3' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'ivr_email_4' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'ivr_email_5' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'ivr_fax' => ['nullable', 'string', 'min:10', 'min:12'],
            'onsite_phone_1' => ['nullable', 'string', 'min:10', 'min:12'],
            'onsite_phone_2' => ['nullable', 'string', 'min:10', 'min:12'],
            'onsite_phone_3' => ['nullable', 'string', 'min:10', 'min:12'],
            'onsite_phone_4' => ['nullable', 'string', 'min:10', 'min:12'],
            'onsite_phone_5' => ['nullable', 'string', 'min:10', 'min:12'],
            'onsite_email_1' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'onsite_email_2' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'onsite_email_3' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'onsite_email_4' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'onsite_email_5' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'onsite_fax' => ['nullable', 'string', 'min:10', 'min:12'],
            'remittance_phone_1' => ['nullable', 'string', 'min:10', 'min:12'],
            'remittance_phone_2' => ['nullable', 'string', 'min:10', 'min:12'],
            'remittance_phone_3' => ['nullable', 'string', 'min:10', 'min:12'],
            'remittance_phone_4' => ['nullable', 'string', 'min:10', 'min:12'],
            'remittance_phone_5' => ['nullable', 'string', 'min:10', 'min:12'],
            'remittance_email_1' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'remittance_email_2' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'remittance_email_3' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'remittance_email_4' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'remittance_email_5' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'remittance_fax' => ['nullable', 'string', 'min:10', 'min:12'],
            'active' => ['nullable', 'boolean'],
        ]);

        if (auth()->user()->client()->create($validated))
        {
            $this->dispatch('toast', message: "Client successfully created!", type: "success");

            $this->potential_client_id = null;
            $this->payment_term_id = null;
            $this->for_brand = null;
            $this->legal_name = '';
            $this->dba = '';
            $this->abbreviation = '';
            $this->legal_entity_type = '';
            $this->registered_state = null;
            $this->onboarding_started = false;
            $this->onboarding_started_date = null;
            $this->onboarding_finished = false;
            $this->onboarding_finished_date = null;
            $this->vendor_packet_complete = false;
            $this->vendor_packet_complete_date = null;
            $this->certificate_of_insurance_requested = false;
            $this->certificate_of_insurance_provided = false;
            $this->certificate_of_insurance_coverage_start_date = null;
            $this->certificate_of_insurance_coverage_end_date = null;
            $this->workers_comp_requested = false;
            $this->workers_comp_provided = false;
            $this->workers_comp_coverage_start_date = null;
            $this->workers_comp_coverage_end_date = null;
            $this->auto_insurance_requested = false;
            $this->auto_insurance_provided = false;
            $this->auto_insurance_coverage_start_date = null;
            $this->auto_insurance_coverage_end_date = null;
            $this->misc_insurance_requested = false;
            $this->misc_insurance_provided = false;
            $this->misc_insurance_coverage_start_date = null;
            $this->misc_insurance_coverage_end_date = null;
            $this->accounts_payables_information_verified = false;
            $this->accounts_receivables_information_verified = false;
            $this->contract_start_date = null;
            $this->contract_end_date = null;
            $this->training_materials = '';
            $this->ivr_and_onsite_protocol = '';
            $this->invoicing_percent_per_invoice = 0;
            $this->invoicing_amount_per_invoice = 0;
            $this->invoicing_percent_per_month = 0;
            $this->invoicing_amount_per_month = 0;
            $this->misc_service_charge_1_description = '';
            $this->misc_service_charge_1_amount = 0;
            $this->misc_service_charge_2_description = '';
            $this->misc_service_charge_2_amount = 0;
            $this->misc_service_charge_3_description = '';
            $this->misc_service_charge_3_amount = 0;
            $this->misc_service_charge_4_description = '';
            $this->misc_service_charge_4_amount = 0;
            $this->misc_service_charge_5_description = '';
            $this->misc_service_charge_5_amount = 0;
            $this->invoicing_required_document_list = null;
            $this->invoicing_instructions = '';
            $this->customer_service_phone_1 = '';
            $this->customer_service_phone_2 = '';
            $this->customer_service_phone_3 = '';
            $this->customer_service_phone_4 = '';
            $this->customer_service_phone_5 = '';
            $this->customer_service_email_1 = '';
            $this->customer_service_email_2 = '';
            $this->customer_service_email_3 = '';
            $this->customer_service_email_4 = '';
            $this->customer_service_email_5 = '';
            $this->customer_service_fax = '';
            $this->invoicing_phone_1 = '';
            $this->invoicing_phone_2 = '';
            $this->invoicing_phone_3 = '';
            $this->invoicing_phone_4 = '';
            $this->invoicing_phone_5 = '';
            $this->invoicing_email_1 = '';
            $this->invoicing_email_2 = '';
            $this->invoicing_email_3 = '';
            $this->invoicing_email_4 = '';
            $this->invoicing_email_5 = '';
            $this->invoicing_fax = '';
            $this->ivr_phone_1 = '';
            $this->ivr_phone_2 = '';
            $this->ivr_phone_3 = '';
            $this->ivr_phone_4 = '';
            $this->ivr_phone_5 = '';
            $this->ivr_email_1 = '';
            $this->ivr_email_2 = '';
            $this->ivr_email_3 = '';
            $this->ivr_email_4 = '';
            $this->ivr_email_5 = '';
            $this->ivr_fax = '';
            $this->onsite_phone_1 = '';
            $this->onsite_phone_2 = '';
            $this->onsite_phone_3 = '';
            $this->onsite_phone_4 = '';
            $this->onsite_phone_5 = '';
            $this->onsite_email_1 = '';
            $this->onsite_email_2 = '';
            $this->onsite_email_3 = '';
            $this->onsite_email_4 = '';
            $this->onsite_email_5 = '';
            $this->onsite_fax = '';
            $this->remittance_phone_1 = '';
            $this->remittance_phone_2 = '';
            $this->remittance_phone_3 = '';
            $this->remittance_phone_4 = '';
            $this->remittance_phone_5 = '';
            $this->remittance_email_1 = '';
            $this->remittance_email_2 = '';
            $this->remittance_email_3 = '';
            $this->remittance_email_4 = '';
            $this->remittance_email_5 = '';
            $this->remittance_fax = '';
            $this->active = false;
        } else {
            $this->dispatch('toast', message: "Client could not be created.", type: "failure");
        }
    }

    public function getPotentialClients(): void
    {
        $this->potentialClients = PotentialClient::where('converted', '=', 0)->get();
    }

    public function getClients(): void
    {
        $this->clients = Client::get();
    }

    public function getBrands(): void
    {
        $this->brands = Brand::where('active', '=', true)->get();
    }

    public function getStates(): void
    {
        $this->states = States::orderBy('name')->get();
    }

    public function getPaymentTerms(): void
    {
        $this->payment_terms = PaymentTerm::get();
    }

    public function setClient()
    {
        if ($this->client_id) {
            $this->copyClient = Client::where('id', '=', $this->client_id)->get();
        }


        if (isset($this->copyClient[0]) && !empty($this->copyClient[0])) {
            $this->dispatch('toast', message:'Client loaded!', title:'success');
            $this->populateForm();
            $this->dispatch('client-loaded');
            return back()->with('success','Item created successfully!');
        } else {
            $this->dispatch('toast', message:'Client not loaded.', type:'failure');
        }
    }

    public function renewData(): void
    {
        $this->getPotentialClients();
        $this->getClients();
        $this->getBrands();
    }

    public function populateForm(): void
    {
        $this->client_id = null;
        $this->potential_client_id = $this->copyClient[0]->potential_client_id;
        $this->payment_term_id = $this->copyClient[0]->payment_term_id;
        $this->for_brand = $this->copyClient[0]->for_brand;
        $this->legal_name = $this->copyClient[0]->legal_name;
        $this->dba = $this->copyClient[0]->dba;
        $this->abbreviation = $this->copyClient[0]->abbreviation;
        $this->legal_entity_type = $this->copyClient[0]->legal_entity_type;
        $this->registered_state = $this->copyClient[0]->registered_state;
        $this->onboarding_started = $this->copyClient[0]->onboarding_started;
        $this->onboarding_started_date = $this->copyClient[0]->onboarding_started_date;
        $this->onboarding_finished = $this->copyClient[0]->onboarding_finished;
        $this->onboarding_finished_date = $this->copyClient[0]->onboarding_finished_date;
        $this->vendor_packet_complete = $this->copyClient[0]->vendor_packet_complete;
        $this->vendor_packet_complete_date = $this->copyClient[0]->vendor_packet_complete_date;
        $this->certificate_of_insurance_requested = $this->copyClient[0]->certificate_of_insurance_requested;
        $this->certificate_of_insurance_provided = $this->copyClient[0]->certificate_of_insurance_provided;
        $this->certificate_of_insurance_coverage_start_date = $this->copyClient[0]->certificate_of_insurance_coverage_start_date;
        $this->certificate_of_insurance_coverage_end_date = $this->copyClient[0]->certificate_of_insurance_coverage_end_date;
        $this->workers_comp_requested = $this->copyClient[0]->legal_namworkers_comp_requested;
        $this->workers_comp_provided = $this->copyClient[0]->workers_comp_provided;
        $this->workers_comp_coverage_start_date = $this->copyClient[0]->workers_comp_coverage_start_date;
        $this->workers_comp_coverage_end_date = $this->copyClient[0]->workers_comp_coverage_end_date;
        $this->auto_insurance_requested = $this->copyClient[0]->auto_insurance_requested;
        $this->auto_insurance_provided = $this->copyClient[0]->auto_insurance_provided;
        $this->auto_insurance_coverage_start_date = $this->copyClient[0]->auto_insurance_coverage_start_date;
        $this->auto_insurance_coverage_end_date = $this->copyClient[0]->auto_insurance_coverage_end_date;
        $this->misc_insurance_requested = $this->copyClient[0]->misc_insurance_requested;
        $this->misc_insurance_provided = $this->copyClient[0]->mis_insurance_provided;
        $this->misc_insurance_coverage_start_date = $this->copyClient[0]->misc_insurance_coverage_start_date;
        $this->misc_insurance_coverage_end_date = $this->copyClient[0]->misc_insurance_coverage_end_date;
        $this->accounts_payables_information_verified = $this->copyClient[0]->accounts_payables_information_verified;
        $this->accounts_receivables_information_verified = $this->copyClient[0]->accounts_receivables_information_verified;
        $this->contract_start_date = $this->copyClient[0]->contract_start_date;
        $this->contract_end_date = $this->copyClient[0]->contract_end_date;
        $this->training_materials = $this->copyClient[0]->traning_materials;
        $this->ivr_and_onsite_protocol = $this->copyClient[0]->ivr_and_onsite_protocol;
        $this->invoicing_percent_per_invoice = $this->copyClient[0]->invoicing_percent_per_invoice;
        $this->invoicing_amount_per_invoice = $this->copyClient[0]->invoicing_amount_per_invoice;
        $this->invoicing_percent_per_month = $this->copyClient[0]->invoicing_percenter_per_month;
        $this->invoicing_amount_per_month = $this->copyClient[0]->invoicing_amount_per_month;
        $this->misc_service_charge_1_description = $this->copyClient[0]->misc_service_charge_1_description;
        $this->misc_service_charge_1_amount = $this->copyClient[0]->misc_service_charge_1_amount;
        $this->misc_service_charge_2_description = $this->copyClient[0]->misc_service_charge_2_description;
        $this->misc_service_charge_2_amount = $this->copyClient[0]->misc_service_charge_2_amount;
        $this->misc_service_charge_3_description = $this->copyClient[0]->misc_service_charge_3_description;
        $this->misc_service_charge_3_amount = $this->copyClient[0]->misc_service_charge_3_amount;
        $this->misc_service_charge_4_description = $this->copyClient[0]->misc_service_charge_4_description;
        $this->misc_service_charge_4_amount = $this->copyClient[0]->misc_service_charge_4_amount;
        $this->misc_service_charge_5_description = $this->copyClient[0]->misc_service_charge_5_description;
        $this->misc_service_charge_5_amount = $this->copyClient[0]->misc_service_charge_5_amount;
        $this->invoicing_required_document_list = $this->copyClient[0]->invoicing_required_document_list;
        $this->invoicing_instructions = $this->copyClient[0]->invoicing_instructions;
        $this->customer_service_phone_1 = $this->copyClient[0]->customer_service_phone_1;
        $this->customer_service_phone_2 = $this->copyClient[0]->customer_service_phone_2;
        $this->customer_service_phone_3 = $this->copyClient[0]->customer_service_phone_3;
        $this->customer_service_phone_4 = $this->copyClient[0]->customer_service_phone_4;
        $this->customer_service_phone_5 = $this->copyClient[0]->customer_service_phone_5;
        $this->customer_service_email_1 = $this->copyClient[0]->customer_service_email_1;
        $this->customer_service_email_2 = $this->copyClient[0]->customer_service_email_2;
        $this->customer_service_email_3 = $this->copyClient[0]->customer_service_email_3;
        $this->customer_service_email_4 = $this->copyClient[0]->customer_service_email_4;
        $this->customer_service_email_5 = $this->copyClient[0]->customer_service_email_5;
        $this->customer_service_fax = $this->copyClient[0]->customer_service_fax;
        $this->invoicing_email_phone_1 = $this->copyClient[0]->invoicing_email_phone_1;
        $this->invoicing_email_phone_2 = $this->copyClient[0]->invoicing_email_phone_2;
        $this->invoicing_email_phone_3 = $this->copyClient[0]->invoicing_email_phone_3;
        $this->invoicing_email_phone_4 = $this->copyClient[0]->invoicing_email_phone_4;
        $this->invoicing_email_phone_5 = $this->copyClient[0]->invoicing_email_phone_5;
        $this->invoicing_email_email_1 = $this->copyClient[0]->invoicing_email_email_1;
        $this->invoicing_email_email_2 = $this->copyClient[0]->invoicing_email_email_2;
        $this->invoicing_email_email_3 = $this->copyClient[0]->invoicing_email_email_3;
        $this->invoicing_email_email_4 = $this->copyClient[0]->invoicing_email_email_4;
        $this->invoicing_email_email_5 = $this->copyClient[0]->invoicing_email_email_5;
        $this->invoicing_email_fax = $this->copyClient[0]->invoicing_email_fax;
        $this->invoicing_fax = $this->copyClient[0]->fax;
        $this->ivr_phone_1 = $this->copyClient[0]->ivr_phone_1;
        $this->ivr_phone_2 = $this->copyClient[0]->ivr_phone_2;
        $this->ivr_phone_3 = $this->copyClient[0]->ivr_phone_3;
        $this->ivr_phone_4 = $this->copyClient[0]->ivr_phone_4;
        $this->ivr_phone_5 = $this->copyClient[0]->ivr_phone_5;
        $this->ivr_email_1 = $this->copyClient[0]->ivr_email_1;
        $this->ivr_email_2 = $this->copyClient[0]->ivr_email_2;
        $this->ivr_email_3 = $this->copyClient[0]->ivr_email_3;
        $this->ivr_email_4 = $this->copyClient[0]->ivr_email_4;
        $this->ivr_email_5 = $this->copyClient[0]->ivr_email_5;
        $this->ivr_fax = $this->copyClient[0]->ivr_fax;
        $this->onsite_phone_1 = $this->copyClient[0]->onsite_phone_1;
        $this->onsite_phone_2 = $this->copyClient[0]->onsite_phone_2;
        $this->onsite_phone_3 = $this->copyClient[0]->onsite_phone_3;
        $this->onsite_phone_4 = $this->copyClient[0]->onsite_phone_4;
        $this->onsite_phone_5 = $this->copyClient[0]->onsite_phone_5;
        $this->onsite_email_1 = $this->copyClient[0]->onsite_email_1;
        $this->onsite_email_2 = $this->copyClient[0]->onsite_email_2;
        $this->onsite_email_3 = $this->copyClient[0]->onsite_email_3;
        $this->onsite_email_4 = $this->copyClient[0]->onsite_email_4;
        $this->onsite_email_5 = $this->copyClient[0]->onsite_email_5;
        $this->onsite_fax = $this->copyClient[0]->onsite_fax;
        $this->remittance_phone_1 = $this->copyClient[0]->remittance_phone_1;
        $this->remittance_phone_2 = $this->copyClient[0]->remittance_phone_2;
        $this->remittance_phone_3 = $this->copyClient[0]->remittance_phone_3;
        $this->remittance_phone_4 = $this->copyClient[0]->remittance_phone_4;
        $this->remittance_phone_5 = $this->copyClient[0]->remittance_phone_5;
        $this->remittance_email_1 = $this->copyClient[0]->remittance_email_1;
        $this->remittance_email_2 = $this->copyClient[0]->remittance_email_2;
        $this->remittance_email_3 = $this->copyClient[0]->remittance_email_3;
        $this->remittance_email_4 = $this->copyClient[0]->remittance_email_4;
        $this->remittance_email_5 = $this->copyClient[0]->remittance_email_5;
        $this->remittance_fax = $this->copyClient[0]->remittance_fax;
        $this->active = $this->copyClient[0]->active;
    }
}; ?>

<div>
    <div class="tw-w-full tw-mx-auto">
        <form wire:submit="store">
            <div class="row">

            </div>
            <div class="row">
                <div class="col-md-3 mb-4 md:mb-0">
                    <div class="form-floating has-validation">
                        @if (empty($potentialClients[0]))
                            <select
                                name="potential-client-id"
                                id="potential-client-id"
                                wire:model.live="potential_client_id"
                                wire:poll.visible="renewData"
                                class="form-select rounded-lg"
                                disabled
                            >
                                <option selected>{{ __('None available')}}</option>
                            </select>
                            <label for="potential-client-id">{{ __('Potential Client to Convert') }}</label>
                            <x-input-error :messages="$errors->get('potential-client-id')" class="mt-2"/>
                        @else
                            <select
                                name="potential-client-id"
                                id="potential-client-id"
                                wire:model.live="potential_client_id"
                                wire:poll.visible="renewData"
                                class="form-select rounded-lg"
                            >
                                <option selected></option>
                                @foreach ($potentialClients as $potentialClient)
                                    <option
                                        value="{{ $potentialClient->id }}">{{ $potentialClient->legal_name }}</option>
                                @endforeach
                            </select>
                            <label for="potential-client-id">{{ __('Potential client to convert') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        @if (empty($clients[0]))
                            <select
                                name="client-id"
                                id="client-id"
                                wire:model.live="client_id"
                                class="form-select rounded-lg"
                                disabled
                            >
                                <option selected>{{ __('None Available') }}</option>
                            </select>
                            <label for="client-id">{{ __('Client to convert') }}</label>
                        @else
                            <select
                                name="client-id"
                                id="client-id"
                                wire:model.live="client_id"
                                class="form-select rounded-lg"
                                x-on:change="$wire.setClient()"
                            >
                                <option selected></option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->legal_name }}</option>
                                @endforeach
                            </select>
                            <label for="client_id">{{ __('Client to copy') }}</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        @if (empty($brands[0]))
                            <select
                                name="for-brand"
                                id="for-brand"
                                wire:model.live="for_brand"
                                class="form-select rounded-lg"
                                disabled
                            >
                                <option selected>{{ __('None available') }}</option>
                            </select>
                            <label for="for-brand">{{ __('Associated brand') }}</label>
                        @else
                            <select
                                name="for-brand"
                                id="for-brand"
                                wire:model.live="for_brand"
                                class="form-select rounded-lg"
                            >
                                <option selected></option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->legal_name }}</option>
                                @endforeach
                                <label for="for-brand">{{ __('Associated Brand') }}</label>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating tw-mb-4 has-validation">
                        <input
                            type="text"
                            name="legal-name"
                            id="legal-name"
                            wire:model.live="legal_name"
                            class="form-control @error('legal_name') is-invalid @enderror"
                            placeholder="Legal Name"
                        >
                        <label for="legal-name">{{ __('Legal Name') }}</label>
                        <x-input-error :messages="$errors->get('legal_name')" class="tw-text-xs tw-text-red-500 mt-2"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="text"
                            name="dba"
                            id="dba"
                            wire:model.live="dba"
                            class="form-control @error('dba') is-invalid @enderror"
                            placeholder="DBA"
                        >
                        <label for="dba">{{ __('DBA') }}</label>
                        <x-input-error :messages="$errors->get('dba')" class="tw-text-xs tw-text-red-500 mt-2"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="text"
                            name="abbreviation"
                            id="abbreviation"
                            wire:model.live="abbreviation"
                            class="form-control @error('abbreviation') is-invalid @enderror"
                            placeholder="Abbreviation"
                        >
                        <label for="abbreviation">{{ __('Abbreviation') }}</label>
                        <x-input-error :messages="$errors->get('abbreviation')" class="tw-text-xs tw-text-red-500 mt-2"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <select
                            name="legal-entity-type"
                            id="legal-entity-type"
                            wire:model="legal_entity_type"
                            class="form-select rounded-lg"
                        >
                            <option selected></option>
                            <option value="llc">{{ __('LLC') }}</option>
                            <option value="s-corporation">{{ __('S corporation') }}</option>
                            <option value="c-corporation">{{ __('C corporation') }}</option>
                            <option value="nonprofit">{{ __('Nonprofit') }}</option>
                            <option value="Sole proprietorship">{{ __('Sole proprietorship') }}</option>
                        </select>
                        <label for="legal-entity-type">{{ __('Entity type') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <select
                            name="registered-state"
                            id="registered-state"
                            wire:model="registered_state"
                            class="form-select rounded-lg"
                        >
                            <option selected></option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <label for="registered-state">{{ __('Registered state') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row">
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="onboarding-started"
                            name="onboarding-started"
                            wire:model="onboarding_started"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="onboarding-started" class="tw-ps-2">Onboarding started</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="date"
                            name="onboarding-started-date"
                            id="onboarding-started-date"
                            wire:model="onboarding_started_date"
                            class="form-control"
                        >
                        <label for="onboarding-started-date">{{ __('Date') }}</label>
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
                    <label for="onboarding-finished" class="tw-ps-2">Onboarding finished</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="date"
                            name="onboarding-finished-date"
                            id="onboarding-finished-date"
                            wire:model="onboarding_finished_date"
                            class="form-control"
                        >
                        <label for="onboarding-finished-date">{{ __('Date') }}</label>
                    </div>
                </div>
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="vendor-packet-complete"
                            name="vendor-packet-complete"
                            wire:model="vendor_packet_complete"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="vendor-packet-complete" class="tw-ps-2">Vendor packet complete</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="date"
                            name="vendor-packet-complete-date"
                            id="vendor-packet-complete-date"
                            wire:model="vendor_packet_complete_date"
                            class="form-control"
                        >
                        <label for="vendor-packet-complete-date">{{ __('Date') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row">
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="certificate-of-insurance-requested"
                            name="certificate-of-insurance-requested"
                            wire:model="certificate_of_insurance_requested"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="certificate-of-insurance-requested" class="tw-ps-2">COI requested</label>
                </div>
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="certificate-of-insurance-provided"
                            name="certificate-of-insurance-provided"
                            wire:model="certificate_of_insurance_provided"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="certificate-of-insurance-provided" class="tw-ps-2">COI provided</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="certificate-of-insurance-coverage-start-date"
                            id="certificate-of-insurance-coverage-start-date"
                            wire:model="certificate_of_insurance_coverage_start_date"
                            class="form-control"
                        >
                        <label
                            for="certificate-of-insurance-coverage-start-date">{{ __('Coverage start date') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="certificate-of-insurance-coverage-end-date"
                            id="certificate-of-insurance-coverage-end-date"
                            wire:model="certificate_of_insurance_coverage_end_date"
                            class="form-control"
                        >
                        <label for="certificate-of-insurance-coverage-end-date">{{ __('Coverage end date') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="workers-comp-requested"
                            name="workers-comp-requested"
                            wire:model="workers_comp_requested"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="workers-comp-requested" class="tw-ps-2">Workers comp provided</label>
                </div>
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="workers-comp-provided"
                            name="workers-comp-provided"
                            wire:model="workers_comp_provided"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="workers-comp-provided" class="tw-ps-2">Workers comp provided</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="workers-comp-coverage-start-date"
                            id="workers-comp-coverage-start-date"
                            wire:model="workers_comp_coverage_start_date"
                            class="form-control"
                        >
                        <label for="workers-comp-coverage-start-date">{{ __('Coverage start date') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="workers-comp-coverage-end-date"
                            id="workers-comp-coverage-end-date"
                            wire:model="workers_comp_coverage_end_date"
                            class="form-control"
                        >
                        <label for="workers-comp-coverage-end-date">{{ __('Coverage end date') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="auto-insurance-requested"
                            name="auto-insurance-requested"
                            wire:model="auto_insurance_requested"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="auto-insurance-requested" class="tw-ps-2">Auto provided</label>
                </div>
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="auto-insurance-provided"
                            name="auto-insurance-provided"
                            wire:model="auto_insurance_provided"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="auto-insurance-provided" class="tw-ps-2">Auto provided</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="auto-insurance-coverage-start-date"
                            id="auto-insurance-coverage-start-date"
                            wire:model="auto_insurance_coverage_start_date"
                            class="form-control"
                        >
                        <label for="auto-insurance-coverage-start-date">{{ __('Coverage start date') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="auto-insurance-coverage-end-date"
                            id="auto-insurance-coverage-end-date"
                            wire:model="auto_insurance_coverage_end_date"
                            class="form-control"
                        >
                        <label for="auto-insurance-coverage-end-date">{{ __('Coverage end date') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="misc-insurance-requested"
                            name="misc-insurance-requested"
                            wire:model="misc_insurance_requested"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="misc-insurance-requested" class="tw-ps-2">Misc provided</label>
                </div>
                <div class="col-md-2 w-fit tw-flex tw-items-center tw-justify-start">
                    <div class="tw-relative tw-inline-block">
                        <input
                            type="checkbox"
                            id="misc-insurance-provided"
                            name="misc-insurance-provided"
                            wire:model="misc_insurance_provided"
                            class="tw-peer tw-relative tw-w-11 tw-h-6 tw-p-px tw-bg-gray-100 tw-border-transparent tw-text-transparent tw-rounded-full tw-cursor-pointer tw-transition-colors tw-ease-in-out tw-duration-200 focus:tw-ring-blue-600 disabled:tw-opacity-50 disabled:tw-pointer-events-none checked:tw-bg-none checked:tw-text-blue-600 checked:tw-border-blue-600 focus:checked:tw-border-blue-600 dark:tw-bg-gray-800 dark:tw-border-gray-700 dark:checked:tw-bg-blue-500 dark:checked:tw-border-blue-500 dark:focus:tw-ring-offset-gray-600 before:tw-inline-block before:tw-size-5 before:tw-bg-white checked:before:tw-bg-blue-200 before:tw-translate-x-0 checked:before:tw-translate-x-full before:tw-rounded-full before:tw-shadow before:tw-transform before:tw-ring-0 before:tw-transition before:tw-ease-in-out before:tw-duration-200 dark:before:tw-bg-gray-400 dark:checked:before:tw-bg-blue-200"
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
                    <label for="misc-insurance-provided" class="tw-ps-2">Misc provided</label>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="misc-insurance-coverage-start-date"
                            id="misc-insurance-coverage-start-date"
                            wire:model="misc_insurance_coverage_start_date"
                            class="form-control"
                        >
                        <label for="misc-insurance-coverage-start-date">{{ __('Coverage start date') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating tw-mb-4">
                        <input
                            type="date"
                            name="misc-insurance-coverage-end-date"
                            id="misc-insurance-coverage-end-date"
                            wire:model="misc_insurance_coverage_end_date"
                            class="form-control"
                        >
                        <label for="misc-insurance-coverage-end-date">{{ __('Coverage end date') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="date"
                            name="contract-start-date"
                            id="contract-start-date"
                            wire:model="contract_start_date"
                            class="form-control"
                        >
                        <label for="contract-start-date">{{ __('Contract start date') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="date"
                            name="contract-end-date"
                            id="contract-end-date"
                            wire:model="contract_end_date"
                            class="form-control"
                        >
                        <label for="contract-end-date">{{ __('Contract end date') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group">
                        <div class="form-floating">
                            <input
                                type="number"
                                name="invoicing-percent-per-invoice"
                                id="invoicing-percent-per-invoice"
                                wire:model="invoicing_percent_per_invoice"
                                min="0.00"
                                max="100.00"
                                step="0.01"
                                class="form-control"
                                placeholder="Charged percent per invoice"
                            >
                            <label for="invoicing-percent-per-invoice">{{ __('Charged percent per invoice') }}</label>
                        </div>
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <div class="form-floating">
                            <input
                                type="number"
                                name="invoicing-amount-per-invoice"
                                id="invoicing-amount-per-invoice"
                                wire:model="invoicing_amount_per_invoice"
                                min="0.00"
                                step="0.01"
                                class="form-control"
                                placeholder="Charged amount per invoice"
                            >
                            <label for="invoicing-amount-per-invoice">{{ __('Charged amount per invoice') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <div class="form-floating">
                            <input
                                type="number"
                                name="invoicing-percent-per-month"
                                id="invoicing-percent-per-month"
                                wire:model="invoicing_percent_per_month"
                                min="0.00"
                                max="100.00"
                                step="0.01"
                                class="form-control"
                                placeholder="Charged percent per month"
                            >
                            <label for="invoicing-percent-per-month">{{ __('Charged percent per month') }}</label>
                        </div>
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <div class="form-floating">
                            <input
                                type="number"
                                name="invoicing-amount-per-month"
                                id="invoicing-amount-per-month"
                                wire:model="invoicing_amount_per_month"
                                min="0.00"
                                step="0.01"
                                class="form-control"
                                placeholder="Charged amount per month"
                            >
                            <label for="invoicing-amount-per-month">{{ __('Charged amount per month') }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select
                            name="payment-term-id"
                            id="payment-term-id"
                            wire:model.live="payment_term_id"
                            class="form-select rounded-lg"
                        >
                            <option selected></option>
                            @foreach ($payment_terms as $payment_term)
                                <option value="{{ $payment_term->id }}">{{ $payment_term->code }} - {{ $payment_term->title }}</option>
                            @endforeach
                        </select>
                        <label for="payment-term-id">{{ __('Payment Terms') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row">
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-phone-1"
                            id="customer-service-phone-1"
                            wire:model="customer_service_phone_1"
                            class="form-control"
                            placeholder="Customer service phone number 1"
                            x-mask="999-999-9999"
                        >
                        <label for="customer-service-phone-1">{{ __('Customer service phone number 1') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-phone-2"
                            id="customer-service-phone-2"
                            wire:model="customer_service_phone_2"
                            class="form-control"
                            placeholder="Customer service phone number 2"
                            x-mask="999-999-9999"
                        >
                        <label for="customer-service-phone-2">{{ __('Customer service phone number 2') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-phone-3"
                            id="customer-service-phone-3"
                            wire:model="customer_service_phone_3"
                            class="form-control"
                            placeholder="Customer service phone number 3"
                            x-mask="999-999-9999"
                        >
                        <label for="customer-service-phone-3">{{ __('Customer service phone number 3') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-phone-4"
                            id="customer-service-phone-4"
                            wire:model="customer_service_phone_4"
                            class="form-control"
                            placeholder="Customer service phone number 4"
                            x-mask="999-999-9999"
                        >
                        <label for="customer-service-phone-4">{{ __('Customer service phone number 4') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-phone-5"
                            id="customer-service-phone-5"
                            wire:model="customer_service_phone_5"
                            class="form-control"
                            placeholder="Customer service phone number 5"
                            x-mask="999-999-9999"
                        >
                        <label for="customer-service-phone-5">{{ __('Customer service phone number 5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-email-1"
                            id="customer-service-email-1"
                            wire:model="customer_service_email_1"
                            class="form-control"
                            placeholder="Customer service email  1"
                        >
                        <label for="customer-service-email-1">{{ __('Customer service email  1') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-email-2"
                            id="customer-service-email-2"
                            wire:model="customer_service_email_2"
                            class="form-control"
                            placeholder="Customer service email  2"
                        >
                        <label for="customer-service-email-2">{{ __('Customer service email  2') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-email-3"
                            id="customer-service-email-3"
                            wire:model="customer_service_email_3"
                            class="form-control"
                            placeholder="Customer service email  3"
                        >
                        <label for="customer-service-email-3">{{ __('Customer service email  3') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-email-4"
                            id="customer-service-email-4"
                            wire:model="customer_service_email_4"
                            class="form-control"
                            placeholder="Customer service email  4"
                        >
                        <label for="customer-service-email-4">{{ __('Customer service email  4') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="customer-service-email-5"
                            id="customer-service-email-5"
                            wire:model="customer_service_email_5"
                            class="form-control"
                            placeholder="Customer service email  5"
                        >
                        <label for="customer-service-email-5">{{ __('Customer service email  5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <hr class="tw-border-dotted tw-border-gray-400 tw-w-[85%] tw-mx-auto tw-my-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-phone-1"
                            id="invoicing-phone-1"
                            wire:model="invoicing_phone_1"
                            class="form-control"
                            placeholder="Invoicing phone number 1"
                            x-mask="999-999-9999"
                        >
                        <label for="invoicing-phone-1">{{ __('Invoicing phone number 1') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-phone-2"
                            id="invoicing-phone-2"
                            wire:model="invoicing_phone_2"
                            class="form-control"
                            placeholder="Invoicing phone number 2"
                            x-mask="999-999-9999"
                        >
                        <label for="invoicing-phone-2">{{ __('Invoicing phone number 2') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-phone-3"
                            id="invoicing-phone-3"
                            wire:model="invoicing_phone_3"
                            class="form-control"
                            placeholder="Invoicing phone number 3"
                            x-mask="999-999-9999"
                        >
                        <label for="invoicing-phone-3">{{ __('Invoicing phone number 3') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-phone-4"
                            id="invoicing-phone-4"
                            wire:model="invoicing_phone_4"
                            class="form-control"
                            placeholder="Invoicing phone number 4"
                            x-mask="999-999-9999"
                        >
                        <label for="invoicing-phone-4">{{ __('Invoicing phone number 4') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-phone-5"
                            id="invoicing-phone-5"
                            wire:model="invoicing_phone_5"
                            class="form-control"
                            placeholder="Invoicing phone number 5"
                            x-mask="999-999-9999"
                        >
                        <label for="invoicing-phone-5">{{ __('Invoicing phone number 5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-email-1"
                            id="invoicing-email-1"
                            wire:model="invoicing_email_1"
                            class="form-control"
                            placeholder="Invoicing email  1"
                        >
                        <label for="invoicing-email-1">{{ __('Invoicing email  1') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-email-2"
                            id="invoicing-email-2"
                            wire:model="invoicing_email_2"
                            class="form-control"
                            placeholder="Invoicing email  2"
                        >
                        <label for="invoicing-email-2">{{ __('Invoicing email  2') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-email-3"
                            id="invoicing-email-3"
                            wire:model="invoicing_email_3"
                            class="form-control"
                            placeholder="Invoicing email  3"
                        >
                        <label for="invoicing-email-3">{{ __('Invoicing email  3') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-email-4"
                            id="invoicing-email-4"
                            wire:model="invoicing_email_4"
                            class="form-control"
                            placeholder="Invoicing email  4"
                        >
                        <label for="invoicing-email-4">{{ __('Invoicing email  4') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="invoicing-email-5"
                            id="invoicing-email-5"
                            wire:model="invoicing_email_5"
                            class="form-control"
                            placeholder="Invoicing email  5"
                        >
                        <label for="invoicing-email-5">{{ __('Invoicing email  5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <hr class="tw-border-dotted tw-border-gray-400 tw-w-[85%] tw-mx-auto tw-my-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-phone-1"
                            id="ivr-phone-1"
                            wire:model="ivr_phone_1"
                            class="form-control"
                            placeholder="IVR phone number 1"
                            x-mask="999-999-9999"
                        >
                        <label for="ivr-phone-1">{{ __('IVR phone number 1') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-phone-2"
                            id="ivr-phone-2"
                            wire:model="ivr_phone_2"
                            class="form-control"
                            placeholder="IVR phone number 2"
                            x-mask="999-999-9999"
                        >
                        <label for="ivr-phone-2">{{ __('IVR phone number 2') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-phone-3"
                            id="ivr-phone-3"
                            wire:model="ivr_phone_3"
                            class="form-control"
                            placeholder="IVR phone number 3"
                            x-mask="999-999-9999"
                        >
                        <label for="ivr-phone-3">{{ __('IVR phone number 3') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-phone-4"
                            id="ivr-phone-4"
                            wire:model="ivr_phone_4"
                            class="form-control"
                            placeholder="IVR phone number 4"
                            x-mask="999-999-9999"
                        >
                        <label for="ivr-phone-4">{{ __('IVR phone number 4') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-phone-5"
                            id="ivr-phone-5"
                            wire:model="ivr_phone_5"
                            class="form-control"
                            placeholder="IVR phone number 5"
                            x-mask="999-999-9999"
                        >
                        <label for="ivr-phone-5">{{ __('IVR phone number 5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-email-1"
                            id="ivr-email-1"
                            wire:model="ivr_email_1"
                            class="form-control"
                            placeholder="IVR email  1"
                        >
                        <label for="ivr-email-1">{{ __('IVR email  1') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-email-2"
                            id="ivr-email-2"
                            wire:model="ivr_email_2"
                            class="form-control"
                            placeholder="IVR email  2"
                        >
                        <label for="ivr-email-2">{{ __('IVR email  2') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-email-3"
                            id="ivr-email-3"
                            wire:model="ivr_email_3"
                            class="form-control"
                            placeholder="IVR email  3"
                        >
                        <label for="ivr-email-3">{{ __('IVR email  3') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-email-4"
                            id="ivr-email-4"
                            wire:model="ivr_email_4"
                            class="form-control"
                            placeholder="IVR email  4"
                        >
                        <label for="ivr-email-4">{{ __('IVR email  4') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="ivr-email-5"
                            id="ivr-email-5"
                            wire:model="ivr_email_5"
                            class="form-control"
                            placeholder="IVR email  5"
                        >
                        <label for="ivr-email-5">{{ __('IVR email  5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <hr class="tw-border-dotted tw-border-gray-400 tw-w-[85%] tw-mx-auto tw-my-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-phone-1"
                            id="onsite-phone-1"
                            wire:model="onsite_phone_1"
                            class="form-control"
                            placeholder="Onsite phone number 1"
                            x-mask="999-999-9999"
                        >
                        <label for="onsite-phone-1">{{ __('Onsite phone number 1') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-phone-2"
                            id="onsite-phone-2"
                            wire:model="onsite_phone_2"
                            class="form-control"
                            placeholder="Onsite phone number 2"
                            x-mask="999-999-9999"
                        >
                        <label for="onsite-phone-2">{{ __('Onsite phone number 2') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-phone-3"
                            id="onsite-phone-3"
                            wire:model="onsite_phone_3"
                            class="form-control"
                            placeholder="Onsite phone number 3"
                            x-mask="999-999-9999"
                        >
                        <label for="onsite-phone-3">{{ __('Onsite phone number 3') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-phone-4"
                            id="onsite-phone-4"
                            wire:model="onsite_phone_4"
                            class="form-control"
                            placeholder="Onsite phone number 4"
                            x-mask="999-999-9999"
                        >
                        <label for="onsite-phone-4">{{ __('Onsite phone number 4') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-phone-5"
                            id="onsite-phone-5"
                            wire:model="onsite_phone_5"
                            class="form-control"
                            placeholder="Onsite phone number 5"
                            x-mask="999-999-9999"
                        >
                        <label for="onsite-phone-5">{{ __('Onsite phone number 5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-email-1"
                            id="onsite-email-1"
                            wire:model="onsite_email_1"
                            class="form-control"
                            placeholder="Onsite email  1"
                        >
                        <label for="onsite-email-1">{{ __('Onsite email  1') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-email-2"
                            id="onsite-email-2"
                            wire:model="onsite_email_2"
                            class="form-control"
                            placeholder="Onsite email  2"
                        >
                        <label for="onsite-email-2">{{ __('Onsite email  2') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-email-3"
                            id="onsite-email-3"
                            wire:model="onsite_email_3"
                            class="form-control"
                            placeholder="Onsite email  3"
                        >
                        <label for="onsite-email-3">{{ __('Onsite email  3') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-email-4"
                            id="onsite-email-4"
                            wire:model="onsite_email_4"
                            class="form-control"
                            placeholder="Onsite email  4"
                        >
                        <label for="onsite-email-4">{{ __('Onsite email  4') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="onsite-email-5"
                            id="onsite-email-5"
                            wire:model="onsite_email_5"
                            class="form-control"
                            placeholder="Onsite email  5"
                        >
                        <label for="onsite-email-5">{{ __('Onsite email  5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <hr class="tw-border-dotted tw-border-gray-400 tw-w-[85%] tw-mx-auto tw-my-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-phone-1"
                            id="remittance-phone-1"
                            wire:model="remittance_phone_1"
                            class="form-control"
                            placeholder="Remittance phone number 1"
                            x-mask="999-999-9999"
                        >
                        <label for="remittance-phone-1">{{ __('Remittance phone number 1') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-phone-2"
                            id="remittance-phone-2"
                            wire:model="remittance_phone_2"
                            class="form-control"
                            placeholder="Remittance phone number 2"
                            x-mask="999-999-9999"
                        >
                        <label for="remittance-phone-2">{{ __('Remittance phone number 2') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-phone-3"
                            id="remittance-phone-3"
                            wire:model="remittance_phone_3"
                            class="form-control"
                            placeholder="Remittance phone number 3"
                            x-mask="999-999-9999"
                        >
                        <label for="remittance-phone-3">{{ __('Remittance phone number 3') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-phone-4"
                            id="remittance-phone-4"
                            wire:model="remittance_phone_4"
                            class="form-control"
                            placeholder="Remittance phone number 4"
                            x-mask="999-999-9999"
                        >
                        <label for="remittance-phone-4">{{ __('Remittance phone number 4') }}</label>
                    </div>
                </div>
                <div class="col-md-2 tw-mb-4">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-phone-5"
                            id="remittance-phone-5"
                            wire:model="remittance_phone_5"
                            class="form-control"
                            placeholder="Remittance phone number 5"
                            x-mask="999-999-9999"
                        >
                        <label for="remittance-phone-5">{{ __('Remittance phone number 5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-email-1"
                            id="remittance-email-1"
                            wire:model="remittance_email_1"
                            class="form-control"
                            placeholder="Remittance email  1"
                        >
                        <label for="remittance-email-1">{{ __('Remittance email  1') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-email-2"
                            id="remittance-email-2"
                            wire:model="remittance_email_2"
                            class="form-control"
                            placeholder="Remittance email  2"
                        >
                        <label for="remittance-email-2">{{ __('Remittance email  2') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-email-3"
                            id="remittance-email-3"
                            wire:model="remittance_email_3"
                            class="form-control"
                            placeholder="Remittance email  3"
                        >
                        <label for="remittance-email-3">{{ __('Remittance email  3') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-email-4"
                            id="remittance-email-4"
                            wire:model="remittance_email_4"
                            class="form-control"
                            placeholder="Remittance email  4"
                        >
                        <label for="remittance-email-4">{{ __('Remittance email  4') }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input
                            type="text"
                            name="remittance-email-5"
                            id="remittance-email-5"
                            wire:model="remittance_email_5"
                            class="form-control"
                            placeholder="Remittance email  5"
                        >
                        <label for="remittance-email-5">{{ __('Remittance email  5') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row" wire:ignore>
                <div class="col-md-12">
                    <h4 class="tw-mb-4">{{ __('Training material information') }}</h4>
                    <textarea
                        name="training-materials"
                        id="training-materials"
                        wire:model="training_materials"
                    ></textarea>
                    <label for="training-materials" class="tw-sr-only">{{ __('Training materials') }}</label>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row" wire:ignore>
                <div class="col-md-12">
                    <h4 class="tw-mb-4">{{ __('IVR and onsite protocol') }}</h4>
                    <textarea
                        name="ivr-and-onsite-protocol"
                        id="ivr-and-onsite-protocol"
                        wire:model="ivr_and_onsite_protocol"
                    ></textarea>
                    <label for="ivr-and-onsite-protocol" class="tw-sr-only">{{ __('IVR and on-site protocol') }}</label>
                </div>
            </div>
            <div class="row">
                <hr class="tw-my-6 border-gray-400">
            </div>
            <div class="row" wire:ignore>
                <div class="col-md-12 tw-mb-4">
                    <h4 class="tw-mb-4">{{ __('Invoicing Instructions') }}</h4>
                    <textarea
                        name="invoicing-instructions"
                        id="invoicing-instructions"
                        wire:model="invoicing_instructions"
                    ></textarea>
                    <label for="invoicing-instructions" class="tw-sr-only">{{ __('Invoicing Instructions') }}</label>
                </div>
            </div>
            <div class="row" wire:ignore>
                <div class="col-md-12">
                    <div class=" tw-mb-4">
                        <label
                            for="invoicing-required-document-list">{{ __('Invoicing required documents list') }}</label>
                        <input
                            type="text"
                            name="invoicing-required-document-list"
                            id="invoicing-required-document-list"
                            wire:model="invoicing_required_document_list"
                            class="form-control"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tw-flex tw-justify-end">
                    <button
                        type="submit"
                        name="save"
                        id="save"
                        class="tw-w-fit tw-py-3 tw-px-4 tw-inline-flex tw-items-center tw-gap-x-2 tw-text-sm tw-font-semibold tw-rounded-lg tw-border tw-border-transparent tw-bg-blue-600 tw-text-white hover:tw-bg-blue-700 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:focus:tw-outline-none dark:focus:tw-ring-1 dark:focus:tw-ring-gray-600"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    @assets
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    @endassets
    @script
    <script>
        const trainingMaterialsEl = document.querySelector('#training-materials');
        const ivrAndOnSiteProtocolEl = document.querySelector('#ivr-and-onsite-protocol');
        const invoicingInstructionsEl = document.querySelector('#invoicing-instructions');

        const trainingMaterialsEditor = await CKSource.Editor
            .create(document.querySelector( '#training-materials' ), {
                // Editor configuration.
            } )
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('training_materials', editor.getData());
                })
            })
            .catch( e => {
                console.error(e)
            })
        const ivrAndOnsiteProtocolEditor = await CKSource.Editor
            .create(document.querySelector( '#ivr-and-onsite-protocol' ), {
                // Editor configuration.
            } )
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('ivr_and_onsite_protocol', editor.getData());
                })
            })
            .catch( e => {
                console.error(e)
            })
        const invoicingInstructionsEditor = await CKSource.Editor
            .create(document.querySelector( '#invoicing-instructions' ), {
                // Editor configuration.
            } )
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('invoicing_instructions', editor.getData());
                })
            })
            .catch( e => {
                console.error(e)
            })

        const invoicingRequiredDocumentList = document.querySelector('#invoicing-required-document-list');
        const invoicingRequiredDocumentListTagify = new Tagify(invoicingRequiredDocumentList);

        invoicingRequiredDocumentList.addEventListener('change', (e) => {
            @this
        .set('invoicing_required_document_list', e.target.value)
        })

        const submit = document.getElementById('save');
        submit.addEventListener('click', () => {

        });
    </script>
    @endscript
</div>
