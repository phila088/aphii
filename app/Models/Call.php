<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'contact_id',
        'first_name',
        'last_name',
        'phone_office',
        'phone_office_extension',
        'phone_mobile',
        'email',
        'notes',
        'needs_followup',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function followup(): HasOne
    {
        return $this->hasOne(CallFollowups::class);
    }
}
