<?php

namespace App\Repositories\Auth;

use App\Contracts\AuthenticateRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateRepository implements AuthenticateRepositoryInterface
{
    /**
     * Register a new user.
     *
     * @param array<string, mixed> $data
     */
    public function register(array $data): void
    {
        $this->create($data);
    }

    /**
     * Create a new user.
     *
     * @param array<string, mixed> $data
     */
    protected function create(array $data): void
    {
        User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}