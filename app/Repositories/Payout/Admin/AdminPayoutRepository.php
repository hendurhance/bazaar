<?php

namespace App\Repositories\Payout\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\Payout;
use App\Contracts\Repositories\AdminPayoutRepositoryInterface;

class AdminPayoutRepository extends BaseCrudRepository implements AdminPayoutRepositoryInterface
{
    public function __construct(Payout $model)
    {
        parent::__construct($model);
    }

    // Add your custom repository methods here...
}
