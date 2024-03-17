<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'registered_state_id',
        'legal_name',
        'dba',
        'logo_path',
        'legal_entity_type',
        'not_for_profit',
        'company_owned_trucks',
        'company_technicians',
        'company_administrative_employees',
        'company_years_operating',
        'technicians_use_smart_phones',
        'technicians_wear_uniforms',
        'union_contractor',
        'commercial',
        'residential',
        'office_hours_monday_open',
        'office_hours_monday_close',
        'office_hours_tuesday_open',
        'office_hours_tuesday_close',
        'office_hours_wednesday_open',
        'office_hours_wednesday_close',
        'office_hours_thursday_open',
        'office_hours_thursday_close',
        'office_hours_friday_open',
        'office_hours_friday_close',
        'office_hours_saturday_open',
        'office_hours_saturday_close',
        'office_hours_sunday_open',
        'office_hours_sunday_close',
        'service_hours_monday_open',
        'service_hours_monday_close',
        'service_hours_tuesday_open',
        'service_hours_tuesday_close',
        'service_hours_wednesday_open',
        'service_hours_wednesday_close',
        'service_hours_thursday_open',
        'service_hours_thursday_close',
        'service_hours_friday_open',
        'service_hours_friday_close',
        'service_hours_saturday_open',
        'service_hours_saturday_close',
        'service_hours_sunday_open',
        'service_hours_sunday_close',
        'holiday_hours_monday_open',
        'holiday_hours_monday_close',
        'holiday_hours_tuesday_open',
        'holiday_hours_tuesday_close',
        'holiday_hours_wednesday_open',
        'holiday_hours_wednesday_close',
        'holiday_hours_thursday_open',
        'holiday_hours_thursday_close',
        'holiday_hours_friday_open',
        'holiday_hours_friday_close',
        'holiday_hours_saturday_open',
        'holiday_hours_saturday_close',
        'holiday_hours_sunday_open',
        'holiday_hours_sunday_close',
        'physical_address_pre_direction',
        'physical_address_building_number',
        'physical_address_street_name',
        'physical_address_street_type',
        'physical_address_post_direction',
        'physical_address_po_box',
        'physical_address_city',
        'physical_address_state',
        'physical_address_zip',
        'mailing_address_pre_direction',
        'mailing_address_building_number',
        'mailing_address_street_name',
        'mailing_address_street_type',
        'mailing_address_post_direction',
        'mailing_address_po_box',
        'mailing_address_city',
        'mailing_address_state',
        'mailing_address_zip',
        'remittance_address_pre_direction',
        'remittance_address_building_number',
        'remittance_address_street_name',
        'remittance_address_street_type',
        'remittance_address_post_direction',
        'remittance_address_po_box',
        'remittance_address_city',
        'remittance_address_state',
        'remittance_address_zip',
        'internal_work_order_number_prefix',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(States::class);
    }
}