<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // getting the usertype emplty, null, user and artist and displaying it in the UserResouce.php
    public function scopeDisplayUserAndArtistOnly(Builder $query)
    {
        return $query->whereIn('usertype', ['user', 'artist'])
            ->orWhereNull('usertype')
            ->orWhere('usertype', '');
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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'usertype',
        'password',
        'profile_img',
        'email_verified_at'
    ];

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
