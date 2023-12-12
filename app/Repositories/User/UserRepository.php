<?php

namespace App\Repositories\User;

use App\Abstracts\BaseCrudRepository;
use App\Models\User;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Enums\Gender;
use App\Exceptions\UserException;
use App\Repositories\Auth\AuthenticateRepository;
use App\Repositories\Country\CountryRepository;
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
                throw new UserException('User not found.');
            });
    }

    /**
     * Get user for profile
     * 
     * @param array $data
     * @return void
     */
    public function createUser($data): void
    {
        $country = app(CountryRepository::class)->findByIso2Code($data['country']);
        $state = app(CountryRepository::class)->findStateByCode($country->id, $data['state']);
        $this->model->query()->create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'country_id' => $country->id,
            'state_id' => $state->id,
            'city_id' => $data['city'],
            'zip_code' => $data['zip_code'],
            'gender' => Gender::from($data['gender']),
            'is_active' => $data['is_active'] ?? false,
            'address' => $data['address'],
        ]);
    }

     /**
     * Send password reset link
     * 
     * @param string $id
     */
    public function sendPasswordResetLink(string $id): void
    {
        $user = $this->model->query()->where('id', $id)->firstOr(function () {
            throw new UserException('User not found.');
        });

        app(AuthenticateRepository::class)->sendPasswordResetLink($user->email, \App\Models\User::class);
    }

    /**
     * Update user
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateUser(string $id, array $data): void
    {
        $user = $this->model->query()->where('id', $id)->firstOr(function () {
            throw new UserException('User not found.');
        });

        $user->update([
            'name' => $data['first_name'] . ' ' . $data['last_name'] ?? $user->name,
            'address' => $data['address'] ?? $user->address,
            'gender' => Gender::from($data['gender']),
            'zip_code' => $data['zip_code'] ?? $user->zip_code,
            'country' => $data['country'] ?? $user->country,
            'is_active' => $data['is_active'] ?? $user->is_active,
        ]);
    }

    /**
     * Delete a user
     * 
     * @param string $id
     * @return void
     */
    public function deleteUser(string $id): void
    {
        $this->model->query()->where('id', $id)->delete();
    }
}
