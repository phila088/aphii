<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class Client extends Model
{
    use HasStatuses;

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'potential_client_id',
        'payment_term_id',
        'legal_name',
        'dba',
        'abbreviation',
        'legal_entity_type',
        'registered_state',
        'not_for_profit',
        'onboarding_started',
        'onboarding_started_date',
        'onboarding_finished',
        'onboarding_finished_date',
        'vendor_packet_complete',
        'certificate_of_insurance_requested',
        'certificate_of_insurance_provided',
        'certificate_of_insurance_coverage_start_date',
        'certificate_of_insurance_coverage_end_date',
        'workers_comp_requested',
        'workers_comp_provided',
        'workers_comp_coverage_start_date',
        'workers_comp_coverage_end_date',
        'auto_insurance_requested',
        'auto_insurance_provided',
        'auto_insurance_coverage_start_date',
        'auto_insurance_coverage_end_date',
        'misc_insurance_requested',
        'misc_insurance_provided',
        'misc_insurance_coverage_start_date',
        'misc_insurance_coverage_end_date',
        'accounts_payables_information_verified',
        'accounts_receivables_information_verified',
        'contract_start_date',
        'contract_end_date',
        'training_materials',
        'ivr_and_onsite_protocol',
        'invoicing_percent_per_invoice',
        'invoicing_amount_per_invoice',
        'invoicing_percent_per_month',
        'invoicing_amount_per_month',
        'misc_service_charge_1_description',
        'misc_service_charge_1_amount',
        'misc_service_charge_2_description',
        'misc_service_charge_2_amount',
        'misc_service_charge_3_description',
        'misc_service_charge_3_amount',
        'misc_service_charge_4_description',
        'misc_service_charge_4_amount',
        'misc_service_charge_5_description',
        'misc_service_charge_5_amount',
        'invoicing_required_document_list',
        'invoicing_instructions',
        'customer_service_phone_1',
        'customer_service_phone_2',
        'customer_service_phone_3',
        'customer_service_phone_4',
        'customer_service_phone_5',
        'customer_service_email_1',
        'customer_service_email_2',
        'customer_service_email_3',
        'customer_service_email_4',
        'customer_service_email_5',
        'customer_service_fax',
        'invoicing_phone_1',
        'invoicing_phone_2',
        'invoicing_phone_3',
        'invoicing_phone_4',
        'invoicing_phone_5',
        'invoicing_email_1',
        'invoicing_email_2',
        'invoicing_email_3',
        'invoicing_email_4',
        'invoicing_email_5',
        'invoicing_fax',
        'ivr_phone_1',
        'ivr_phone_2',
        'ivr_phone_3',
        'ivr_phone_4',
        'ivr_phone_5',
        'ivr_email_1',
        'ivr_email_2',
        'ivr_email_3',
        'ivr_email_4',
        'ivr_email_5',
        'ivr_fax',
        'on_site_phone_1',
        'on_site_phone_2',
        'on_site_phone_3',
        'on_site_phone_4',
        'on_site_phone_5',
        'on_site_email_1',
        'on_site_email_2',
        'on_site_email_3',
        'on_site_email_4',
        'on_site_email_5',
        'on_site_fax',
        'remittance_phone_1',
        'remittance_phone_2',
        'remittance_phone_3',
        'remittance_phone_4',
        'remittance_phone_5',
        'remittance_email_1',
        'remittance_email_2',
        'remittance_email_3',
        'remittance_email_4',
        'remittance_email_5',
        'remittance_fax',
        'active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function potentialClient(): BelongsTo
    {
        return $this->belongsTo(PotentialClient::class);
    }

    public function states(): BelongsTo
    {
        return $this->belongsTo(States::class);
    }

    public function paymentTerm(): BelongsTo
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function clientBillingInstruction(): HasMany
    {
        return $this->hasMany(ClientBillingInstruction::class);
    }

    public function coverageArea(): HasMany
    {
        return $this->hasMany(ClientCoverageArea::class);
    }

    public function clientNote(): HasMany
    {
        return $this->hasMany(ClientNote::class);
    }

    public function clientRate(): HasMany
    {
        return $this->hasMany(ClientRate::class);
    }

    public function clientPortal(): BelongsTo
    {
        return $this->belongsTo(ClientPortal::class);
    }
}
