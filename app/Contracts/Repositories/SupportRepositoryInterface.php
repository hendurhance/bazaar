<?php

namespace App\Contracts\Repositories;

interface SupportRepositoryInterface
{
    /**
     * Create a new support request
     * 
     * @param array $data
     * @return void
     */
    public function createSupportTicket(array $data): void;

      /**
     * Get all support tickets
     * 
     * @param int $limit
     * @param array $filters
     * @param string $type = 'all' <all|pending|resolved>
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSupportTickets(int $limit = 10, string $type = 'all', array $filters = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get support ticket by id
     * 
     * @param string $id
     * @return \App\Models\Support
     */
    public function getSupportTicket(string $id): \App\Models\Support;

    /**
     * Update support ticket
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateSupportTicket(string $id, array $data): void;

    /**
     * Delete support ticket
     * 
     * @param string $id
     * @return void
     */
    public function deleteSupportTicket(string $id): void;
}