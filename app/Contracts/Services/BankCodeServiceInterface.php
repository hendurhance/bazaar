<?php

namespace App\Contracts\Services;

interface BankCodeServiceInterface
{
    /**
     * List bank codes
     * 
     * @param array $fields
     * @return \Illuminate\Support\Collection
     */
    public function listBankCodes(array $fields = []): \Illuminate\Support\Collection;
}