<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    /**
     * Get states by country.
     * 
     * @param string $iso2code
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStates(string $iso2code): JsonResponse
    {
        return $this->response('states', $this->countryRepository->states($iso2code));
    }

    /**
     * Get cities by country and state.
     * 
     * @param string $iso2code
     * @param string $stateCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities(string $iso2code, string $stateCode): JsonResponse
    {
        return $this->response('cities', $this->countryRepository->cities($iso2code, $stateCode));
    }
}
