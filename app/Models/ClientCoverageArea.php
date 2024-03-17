<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCoverageArea extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'type',
        'value'
    ];

    protected $casts = [
        'type' => ClientCoverageArea::class
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
