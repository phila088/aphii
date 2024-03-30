<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PaymentTerm extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'code',
        'description',
        'net_days',
        'cod_amount',
        'cod_percent',
        'net_amount',
        'net_percent'
    ];
}
