<?php

namespace App\Contracts;

interface AuthenticateRepositoryInterface
{
    /**
     * Register a new user.
     *
     * @param array<string, mixed> $data
     */
    public function register(array $data): void;
}