<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientRate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_id',
        'standard_assessment',
        'emergency_assessment',
        'overtime_assessment',
        'saturday_assessment',
        'sunday_assessment',
        'holiday_assessment',
        'standard_trip',
        'standard_hour',
        'emergency_trip',
        'emergency_hour',
        'overtime_trip',
        'overtime_hour',
        'saturday_trip',
        'saturday_hour',
        'sunday_trip',
        'sunday_hour',
        'holiday_trip',
        'holiday_hour',
        'custom_field_1_description',
        'custom_field_1_amount',
        'custom_field_2_description',
        'custom_field_2_amount',
        'custom_field_3_description',
        'custom_field_3_amount',
        'custom_field_4_description',
        'custom_field_4_amount',
        'custom_field_5_description',
        'custom_field_5_amount',
        'custom_field_6_description',
        'custom_field_6_amount',
        'custom_field_7_description',
        'custom_field_7_amount',
        'custom_field_8_description',
        'custom_field_8_amount',
        'custom_field_9_description',
        'custom_field_9_amount',
        'custom_field_10_description',
        'custom_field_10_amount',
        'active',
        'start_date',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
