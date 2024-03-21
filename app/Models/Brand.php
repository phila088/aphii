<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use OwenIt\Auditing\Contracts\Auditable;

class Brand extends Model implements Auditable
{
    use SoftDeletes, HasStatuses, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'registered_state_id',
        'legal_name',
        'dba',
        'abbreviation',
        'logo_path',
        'legal_entity_type',
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
        'after_hours_monday_open',
        'after_hours_monday_close',
        'after_hours_tuesday_open',
        'after_hours_tuesday_close',
        'after_hours_wednesday_open',
        'after_hours_wednesday_close',
        'after_hours_thursday_open',
        'after_hours_thursday_close',
        'after_hours_friday_open',
        'after_hours_friday_close',
        'after_hours_saturday_open',
        'after_hours_saturday_close',
        'after_hours_sunday_open',
        'after_hours_sunday_close',
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
        'phone_primary',
        'phone_ap',
        'phone_ar',
        'phone_client_relations',
        'phone_customer_service',
        'phone_projects',
        'phone_quoting',
        'phone_sales',
        'email_primary',
        'email_ap',
        'email_ar',
        'email_client_relations',
        'email_customer_service',
        'email_projects',
        'email_quoting',
        'email_sales',
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
        'active',
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
