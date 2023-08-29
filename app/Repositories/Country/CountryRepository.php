<?php

namespace App\Repositories\Country;

use App\Abstracts\BaseCrudRepository;
use App\Models\Country;
use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository extends BaseCrudRepository  implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the countries with states.
     * 
     * @param string $iso2code
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function states(string $iso2code): Collection
    {
        return $this->model->where('iso2', strtoupper($iso2code))->with('states')->get();
    }

    /**
     * Get the cities with states.
     * 
     * @param string $iso2code
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function cities(string $iso2code, string $stateCode): Collection
    {
        $country = $this->findByIso2Code($iso2code);
        return State::where('country_id', $country->id)->where('code', strtoupper($stateCode))->with('cities')->get();
    }

    /**
     * Find a country by its ISO2 code.
     * 
     * @param string $iso2code
     * @return \App\Models\Country
     */
    public function findByIso2Code(string $iso2code): Country
    {
        return $this->findBy('iso2', strtoupper($iso2code), function() {
            throw new \Exception('Country not found.');
        });
    }
}
