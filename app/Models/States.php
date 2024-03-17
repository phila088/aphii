<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class States extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
    ];

    public function brand(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
}
