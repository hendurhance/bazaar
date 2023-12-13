<?php

namespace App\Repositories\Support;

use App\Abstracts\BaseCrudRepository;
use App\Models\Support;
use App\Contracts\Repositories\SupportRepositoryInterface;
use App\Enums\SupportStatusEnum;
use App\Exceptions\SupportException;
use App\Models\Admin;
use App\Notifications\Support\SupportTicketNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Notification;

class SupportRepository extends BaseCrudRepository implements SupportRepositoryInterface
{
    public function __construct(Support $model)
    {
        parent::__construct($model);
    }

    /**
     * Create a new support request
     * 
     * @param array $data
     * @return void
     */
    public function createSupportTicket(array $data): void
    {
        $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'] ?? null,
            'assigned_to' => Admin::inRandomOrder()->first()->id,
        ]);
    }

    /**
     * Get all support tickets
     * 
     * @param int $limit
     * @param array $filters
     * @param string $type = 'all' <all|pending|resolved>
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSupportTickets(int $limit = 10, string $type = 'all', array $filters = []): LengthAwarePaginator
    {
        return $this->model->query()
            ->when(
                match ($type) {
                    'pending' => fn ($query) => $query->pending(),
                    'resolved' => fn ($query) => $query->resolved(),
                    'all' => fn ($query) => $query,
                }
            )
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where(function ($query) use ($filters) {
                        $query->where('id', $filters['search'])
                            ->orWhere('name', 'like', '%' . $filters['search'] . '%')
                            ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                            ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                            ->orWhere('subject', 'like', '%' . $filters['search'] . '%');
                    });
                })
                    ->when(isset($filters['date_from']) && isset($filters['date_to']), function ($query) use ($filters) {
                        $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'search' => $filters['search'] ?? null,
                'date_from' => $filters['date_from'] ?? null,
                'date_to' => $filters['date_to'] ?? null,
            ]);
    }

    /**
     * Get support ticket by id
     * 
     * @param string $id
     * @return \App\Models\Support
     */
    public function getSupportTicket(string $id): \App\Models\Support
    {
        return $this->model->query()
            ->where('id', $id)
            ->firstOr(function () {
                throw new SupportException('Support ticket not found');
            });
    }

    /**
     * Update support ticket
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateSupportTicket(string $id, array $data): void
    {
        $support = $this->model->query()
            ->where('id', $id)
            ->firstOr(function () {
                throw new SupportException('Support ticket not found');
            });
        $support->update([
            'status' => SupportStatusEnum::from($data['status']),
            'response' => $data['response'],
        ]);

        // Send email to user
        Notification::route('mail', $support->email)
            ->notify(new SupportTicketNotification($support));
    }

    /**
     * Delete support ticket
     * 
     * @param string $id
     * @return void
     */
    public function deleteSupportTicket(string $id): void
    {
        $this->model->query()
            ->where('id', $id)
            ->delete();
    }
}
