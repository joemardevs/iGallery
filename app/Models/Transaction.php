<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'artwork_id',
        'user_id',
        'checkout_id',
        'paid_at',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class);
    }
}
