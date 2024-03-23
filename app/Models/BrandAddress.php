<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'brand_id',
        'title',
        'building_number',
        'pre_direction',
        'street_name',
        'street_type',
        'post_direction',
        'unit_type',
        'unit',
        'po_box',
        'city',
        'state',
        'zip'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
