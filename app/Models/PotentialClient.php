<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PotentialClient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_term_id',
        'legal_name',
        'dba',
        'date_of_interview',
        'interview_method',
        'contact_1_first_name',
        'contact_1_last_name',
        'contact_1_phone_number_work',
        'contact_1_phone_number_work_extension',
        'contact_1_phone_number_mobile',
        'contact_1_email',
        'contact_2_first_name',
        'contact_2_last_name',
        'contact_2_phone_number_work',
        'contact_2_phone_number_work_extension',
        'contact_2_phone_number_mobile',
        'contact_2_email',
        'contact_3_first_name',
        'contact_3_last_name',
        'contact_3_phone_number_work',
        'contact_3_phone_number_work_extension',
        'contact_3_phone_number_mobile',
        'contact_3_email',
        'contact_4_first_name',
        'contact_4_last_name',
        'contact_4_phone_number_work',
        'contact_4_phone_number_work_extension',
        'contact_4_phone_number_mobile',
        'contact_4_email',
        'contact_5_first_name',
        'contact_5_last_name',
        'contact_5_phone_number_work',
        'contact_5_phone_number_work_extension',
        'contact_5_phone_number_mobile',
        'contact_5_email',
        'general_notes',
        'client_list',
        'location_types',
        'required_trades',
        'primary_location_locales',
        'average_do_not_exceed',
        'onsite_protocol',
        'complete',
        'converted_to_client',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentTerm(): BelongsTo
    {
        return $this->belongsTo(PaymentTerm::class);
    }
}
