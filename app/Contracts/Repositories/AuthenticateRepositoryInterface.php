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
     * @param mixed $model
     */
    public function sendPasswordResetLink(string $email, mixed $model): void;

    /**
     * Authenticated user.
     * @return ?\App\Models\User|null
     */
    public function user(): ?\App\Models\User;

    /**
     * Authenticated admin.
     * @return ?\App\Models\Admin|null
     */
    public function admin(): ?\App\Models\Admin;    

    /**
     * Reset a user's password.
     * 
     * @param array<string, mixed> $data
     * @param mixed $model
     */
    public function resetPassword(array $data, mixed $model): void;

    /**
     * Update a user's profile.
     * 
     * @param \App\Models\User|\App\Models\Admin  $user
     * @param array<string, mixed> $data
     */
    public function update(\App\Models\User|\App\Models\Admin $user, array $data): void;

    /**
     * Update a user's password.
     * 
     * @param \App\Models\Admin  $admin
     * @param array<string, mixed> $data
     */
    public function updatePassword(\App\Models\Admin $admin, array $data): void;

    /**
     * Send email verification link.
     * 
     * @param \App\Models\User|
     */
    public function sendEmailVerificationLink(\App\Models\User $user): void;
}