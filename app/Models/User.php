<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Gender;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'mobile',
        'gender',
        'email_verification_token',
        'email_verified_at',
        'password',
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
        'gender' => Gender::class,
    ];

    /**
     * Username Attribute.
     * 
     * @return Attribute
     */
    public function username(): Attribute
    {
        return Attribute::make(
            fn ($value) => strtolower($value),
            fn ($value) => strtolower($value)
        );
    }

    /**
     * Get the user's first name.
     * @return string
     */
    public function getFirstNameAttribute(): string
    {
        return implode(' ', array_slice(explode(' ', $this->name), 0, count(explode(' ', $this->name)) / 2)) ?? '';
    }

    /**
     * Get the user's last name.
     * @return string
     */
    public function getLastNameAttribute(): string
    {
        return implode(' ', array_slice(explode(' ', $this->name), count(explode(' ', $this->name)) / 2)) ?? '';
    }

    /**
     * Get the ads for the user.
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
}
