<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPortal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_id',
        'name',
        'description',
        'url',
        'username',
        'password',
        'general_portal',
        'invoicing_only',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
