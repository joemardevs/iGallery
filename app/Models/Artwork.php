<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artwork extends Model
{
    use HasFactory;
    protected static $unguarded = true;
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function artist(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
