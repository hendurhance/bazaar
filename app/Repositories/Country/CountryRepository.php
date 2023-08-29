<?php

namespace App\Repositories\Country;

use App\Abstracts\BaseCrudRepository;
use App\Models\Country;
use App\Contracts\Repositories\CountryRepositoryInterface;

class CountryRepository extends BaseCrudRepository  implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    // Add your custom repository methods here...
}
