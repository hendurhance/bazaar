<?php

namespace App\Repositories\User;

use App\Abstracts\BaseCrudRepository;
use App\Models\User;
use App\Contracts\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends BaseCrudRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Get users for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \App\Models\User
     */
    public function getUsersForAdmin(int $limit = 10, array $filters = []): LengthAwarePaginator
    {
        return $this->model->query()->with('country:id,name,emoji')
            ->when(isset($filters['search']), function ($query) use ($filters) {
                $query->where(function ($query) use ($filters) {
                    $query->where('name', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('mobile', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('username', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('id', $filters['search']);
                });
            })
            ->when(isset($filters['country_id']), function ($query) use ($filters) {
                $query->where('country_id', $filters['country_id']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                match ($filters['status']) {
                    'active' => $query->active(),
                    'inactive' => $query->inactive(),
                    default => $query,
                };
            })
            ->when(isset($filters['date_from']) && isset($filters['date_to']), function ($query) use ($filters) {
                $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'search' => $filters['search'] ?? '',
                'country_id' => $filters['country_id'] ?? '',
                'status' => $filters['status'] ?? '',
                'date_from' => $filters['date_from'] ?? '',
                'date_to' => $filters['date_to'] ?? '',
            ]);
    }

    /**
     * Get user for admin
     * 
     * @param string $id
     * @return \App\Models\User
     */
    public function getUserForAdmin(string $id): \App\Models\User
    {
        return $this->model->query()->with([
            'country:id,name,emoji', 'state:id,name', 'city:id,name',
            'payoutMethods', 'payouts:id,user_id,amount,created_at', 'payments:id,payer_id,amount,created_at', 'receivedPayments:id,payee_id,amount,created_at',
        ])
        ->withCount(['ads', 'bids', 'payoutMethods'])
            ->where('id', $id)
            ->firstOr(function () {
                abort(404);
            });
    }
}
