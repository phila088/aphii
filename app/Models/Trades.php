<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Trades extends Model
{
    use SoftDeletes, NodeTrait;

    protected $fillable = ['name', 'parent_id'];
}
