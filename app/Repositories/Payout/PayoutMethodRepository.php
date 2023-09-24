<?php

namespace App\Repositories\Payout;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payout;
use App\Contracts\Repositories\PayoutMethodRepositoryInterface;

class PayoutMethodRepository extends BaseCrudRepository implements PayoutMethodRepositoryInterface
{
    public function __construct(Payout $model)
    {
        parent::__construct($model);
    }

    // Add your custom repository methods here...
}
