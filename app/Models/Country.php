<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['iso2', 'iso3', 'name', 'phone_code','capital', 'currency', 'currency_symbol', 'currency_code', 'emoji'];

    /**
     * Get the states for the country.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }

    /**
     * Get the timezones for the country.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timezones(): HasMany
    {
        return $this->hasMany(Timezone::class);
    }
}
