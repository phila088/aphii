<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandVendor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand_id',
        'vendor_id',
        'agreement',
        'coi',
        'w9',
    ];
}
