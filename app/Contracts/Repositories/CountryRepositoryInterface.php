<?php

namespace App\Contracts\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    /**
     * Get all countries.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection;

    /**
     * Get the states for the country.
     * 
     * @param string $iso2code
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function states(string $iso2code): Collection;

    /**
     * Get the cities for the state of a country.
     * 
     * @param string $iso2code
     * @param string $stateCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function cities(string $iso2code, string $stateCode): Collection;

    /**
     * Find the country by the ISO2 code.
     * 
     * @param string $iso2code
     * @return \App\Models\Country
     */
    public function findByIso2Code(string $iso2code): Country;
}