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
        'name',
        'dba',
        'abbreviation',
        'onboarding_started',
        'onboarding_started_date',
        'onboarding_finished',
        'onboarding_finished_date',
        'contract_start_date',
        'contract_end_date',
        'payment_term_id',
        'active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentTerm(): BelongsTo
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function clientBillingInstruction(): HasMany
    {
        return $this->hasMany(ClientBillingInstruction::class);
    }

    public function clientContact(): HasMany
    {
        return $this->hasMany(ClientContact::class);
    }

    public function coverageArea(): HasMany
    {
        return $this->hasMany(ClientCoverageArea::class);
    }

    public function clientLocation(): HasMany
    {
        return $this->hasMany(ClientLocation::class);
    }

    public function clientNote(): HasMany
    {
        return $this->hasMany(ClientNote::class);
    }


    public function clientPortal(): BelongsTo
    {
        return $this->belongsTo(ClientPortal::class);
    }
    public function clientRate(): HasMany
    {
        return $this->hasMany(ClientRate::class);
    }
}
