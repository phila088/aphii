<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandPhoneNumber extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'brand_id', 'title', 'number', 'extension'];
}
