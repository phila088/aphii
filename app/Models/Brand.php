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
        'name',
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
}
