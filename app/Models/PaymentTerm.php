<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTerm extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'code',
        'title',
        'amount_cod',
        'percent_cod',
        'amount_net',
        'percent_net',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function potentialClient(): HasMany
    {
        return $this->hasMany(PotentialClient::class);
    }
}
