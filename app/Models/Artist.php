<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function artwork(): BelongsToMany
    {
        return $this->belongsToMany(Artwork::class, 'artist_id');
    }
    public function getAvatarUrlAttribute()
    {
        // Get the first letter of the first name and last name
        $nameParts = explode(' ', $this->name);
        $initials = '';
        foreach ($nameParts as $part) {
            $initials .= strtoupper(mb_substr($part, 0, 1));
        }

        // Return the UI Avatars API URL with the initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&color=FFFFFF&background=09090b';
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
