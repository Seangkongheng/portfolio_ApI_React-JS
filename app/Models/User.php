<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject; // Import the JWTSubject interface
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject // Implement JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Add the two methods required by the JWTSubject interface

    /**
     * Get the identifier that will be stored in the JWT token.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Usually the primary key
    }

    /**
     * Return a key-value array, containing any custom claims to be added to the JWT token.
     */
    public function getJWTCustomClaims()
    {
        return []; // No custom claims, return an empty array
    }
}
