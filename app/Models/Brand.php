<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use OwenIt\Auditing\Contracts\Auditable;

class Brand extends Model implements Auditable
{
    use SoftDeletes, HasStatuses, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'legal_name',
        'dba',
        'abbreviation',
        'internal_work_order_prefix',
        'internal_work_order_max_length',
        'internal_work_order_postfix_increment',
        'logo_path',
        'fein',
        'state_license_number',
        'county_license_number',
        'city_license_number',
        'active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): HasMany
    {
        return $this->hasMany(BrandAddress::class);
    }

    public function email(): HasMany
    {
        return $this->hasMany(BrandEmail::class);
    }

    public function holiday(): HasMany
    {
        return $this->hasMany(BrandHoliday::class);
    }

    public function hours(): HasMany
    {
        return $this->hasMany(BrandHours::class);
    }

    public function phoneNumber(): HasMany
    {
        return $this->hasMany(BrandPhoneNumber::class);
    }

    public function profile(): HasMany
    {
        return $this->hasMany(BrandProfile::class);
    }
}
