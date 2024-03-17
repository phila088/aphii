<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientBillingInstruction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'client_id',
        'instructions',
        'sub_instructions',
        'order',
    ];

    protected $casts = [
        'sub_instructions' => 'array',
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
