<?php

namespace App\Repositories\Payout\User;

use App\Abstracts\BaseCrudRepository;
use App\Contracts\Repositories\PayoutMethodRepositoryInterface;
use App\Exceptions\PayoutMethodException;
use App\Models\PayoutMethod;
use App\Models\User;
use App\Notifications\Payout\PayoutMethodCreatedNotification;
use App\Services\Payout\BankCodeService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PayoutMethodRepository extends BaseCrudRepository implements PayoutMethodRepositoryInterface
{
    public function __construct(PayoutMethod $model)
    {
        parent::__construct($model);
    }

    /**
     * Get user payout methods
     * 
     * @param \App\Models\User $user
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserPayoutMethods(User $user, int $limit = 10): LengthAwarePaginator
    {
        return $this->model->query()->where('user_id', $user->id)->paginate($limit);
    }

    /**
     * Get user payout method
     * 
     * @param \App\Models\User $user
     * @param string $id
     * @return \App\Models\PayoutMethod
     */
    public function getUserPayoutMethod(User $user, string $id): \App\Models\PayoutMethod
    {
        return $this->model->query()->where('user_id', $user->id)
        ->where('id', $id)->firstOr(function () {
            throw new PayoutMethodException('Payout method not found');
        });
    }

    /**
     * Create user payout method
     * 
     * @param \App\Models\User $user
     * @param array $data
     * @return void
     */
    public function createUserPayoutMethod(User $user, array $data): void
    {
        if ($this->model->query()->where('user_id', $user->id)->count() >= 3) {
            throw new PayoutMethodException('You can only add 3 payout methods');
        }
        try {
            $this->model->getConnection()->beginTransaction();
            $bankService = new BankCodeService();
            $bank = $bankService->resolveBankCode($data['bank_code']);
            $resolvedBank = $bankService->resolveBankAccount($data['account_number'], $data['bank_code']);
            $payoutMethod = $this->model->create([
                'user_id' => $user->id,
                'country_id' => $user->country_id,
                'bank_name' => $bank['name'],
                'bank_code' => $data['bank_code'],
                'account_name' => $resolvedBank->account_name,
                'account_number' => $data['account_number'],
                'swift_code' => $data['swift_code'] ?? null,
                'iban' => $data['iban'] ?? null,
                'routing_number' => $data['routing_number'] ?? null,
                'meta' => $data['meta'] ?? null,
            ]);

            $this->model->getConnection()->commit();

            $user->notify(new PayoutMethodCreatedNotification($payoutMethod));
        } catch (\Exception $e) {
            $this->model->getConnection()->rollBack();
            throw new PayoutMethodException('Unable to create payout method');
        }

    }

    /**
     * Update user payout method
     * 
     * @param \App\Models\User $user
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateUserPayoutMethod(User $user, string $id, array $data): void
    {
        $payoutMethod = $this->getUserPayoutMethod($user, $id);

        try {
            $this->model->getConnection()->beginTransaction();
            $bankService = new BankCodeService();
            $bank = $bankService->resolveBankCode($data['bank_code']);
            $resolvedBank = $bankService->resolveBankAccount($data['account_number'], $data['bank_code']);
            $payoutMethod->update([
                'country_id' => $user->country_id ?? $payoutMethod->country_id,
                'bank_name' => $bank['name'] ?? $payoutMethod->bank_name,
                'bank_code' => $data['bank_code'] ?? $payoutMethod->bank_code,
                'account_name' => $resolvedBank->account_name ?? $payoutMethod->account_name,
                'account_number' => $data['account_number'] ?? $payoutMethod->account_number,
                'swift_code' => $data['swift_code'] ?? $payoutMethod->swift_code,
                'iban' => $data['iban'] ?? $payoutMethod->iban,
                'routing_number' => $data['routing_number'] ?? $payoutMethod->routing_number,
                'meta' => $data['meta'] ?? $payoutMethod->meta,
            ]);

            $this->model->getConnection()->commit();
        } catch (\Exception $e) {
            $this->model->getConnection()->rollBack();
            throw new PayoutMethodException('Unable to update payout method');
        }
    }

    /**
     * Delete user payout method
     * 
     * @param \App\Models\User $user
     * @param string $id
     * @return void
     */
    public function deleteUserPayoutMethod(User $user, string $id): void
    {
        $payoutMethod = $this->getUserPayoutMethod($user, $id);

        $payoutMethod->delete();
    }
    
}
