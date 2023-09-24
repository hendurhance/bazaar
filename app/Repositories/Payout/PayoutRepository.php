<?php

namespace App\Repositories\Payout;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payout;
use App\Contracts\Repositories\PayoutRepositoryInterface;

class PayoutRepository extends BaseCrudRepository implements PayoutRepositoryInterface
{
    public function __construct(Payout $model)
    {
        parent::__construct($model);
    }

    // Add your custom repository methods here...
}
