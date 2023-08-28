<?php

namespace App\Contracts\Repositories;

use Illuminate\Http\Request;

interface AuthenticateRepositoryInterface
{
    /**
     * Register a new user.
     *
     * @param array<string, mixed> $data
     * @param bool $isAdmin
     */
    public function register(array $data, bool $isAdmin = false): void;

    /**
     * Login a user.
     * 
     * @param array<string, mixed> $data
     * @param string $guard 
     */
    public function login(array $data, string $guard): void;

    /**
     * Logout a user.
     * 
     * @param Request $request
     * @param string $guard
     */
    public function logout(Request $request, string $guard): void;

    /**
     * Verify a user's email.
     * 
     * @param string $token
     */
    public function verify(string $token): void;

    /**
     * Send a password reset link to a user.
     * 
     * @param string $email
     */
    public function sendPasswordResetLink(string $email): void;


    /**
     * Reset a user's password.
     * 
     * @param array<string, mixed> $data
     */
    public function resetPassword(array $data): void;
}