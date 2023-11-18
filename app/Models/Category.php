<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name',];
    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class);
    }
    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class);
    }
}
