<?php

namespace App\Repositories\Auth;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Exceptions\AuthenticateException;
use App\Models\User;
use App\Models\Admin;
use App\Notifications\User\PasswordResetNotification;
use App\Notifications\User\WelcomeEmailNotification;
use App\Repositories\Country\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateRepository implements AuthenticateRepositoryInterface
{
    public const WEB_GUARD = 'web';
    public const ADMIN_GUARD = 'admin_web';

    /**
     * Register a new user.
     *
     * @param array<string, mixed> $data
     * @param bool $isAdmin
     */
    public function register(array $data, bool $isAdmin = false): void
    {
        match ($isAdmin) {
            true => $this->createAdmin($data),
            false => $this->createUser($data),
        };
    }

    /**
     * Login a user.
     * 
     * @param array<string, mixed> $data
     * @param string $guard 
     */
    public function login(array $data, string $guard): void
    {
        if (!Auth::guard($guard)->attempt($data)) {
            throw new AuthenticateException('Username or password is incorrect.');
        }
    }

    /**
     * Logout a user.
     * 
     * @param Request $request
     * @param string $guard
     */
    public function logout(Request $request, string $guard): void
    {
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /**
     * Verify a user's email.
     * 
     * @param string $token
     */
    public function verify(string $token): void
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            throw new AuthenticateException('Invalid verification token.');
        }

        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
        ]);

        $user->notifyNow(new WelcomeEmailNotification($user));
    }

    /**
     * Send password reset link
     * @param string $email
     */
    public function sendPasswordResetLink(string $email): void
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new AuthenticateException('An error occurred while sending password reset link.');
        }
        $token = generate_password_reset_token($email);
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $user->notifyNow(new PasswordResetNotification($user, $token));
    }

    /**
     * Reset a user's password.
     * 
     * @param array<string, mixed> $data
     */
    public function resetPassword(array $data): void
    {
        $resetToken = DB::table('password_reset_tokens')->where('token', $data['token'])->first();

        if (!$resetToken) {
            throw new AuthenticateException('Invalid password reset token.');
        }

        $user = User::where('email', $resetToken->email)->first();

        if (!$user) {
            throw new AuthenticateException('An error occurred while resetting password.');
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        DB::table('password_reset_tokens')->where('token', $data['token'])->delete();
    }

    /**
     * Authenticated user.
     * @return ?User|null
     */
    public function user(): ?User
    {
        return Auth::guard(self::WEB_GUARD)->user() ?? null;
    }

    /**
     * Authenticated admin.
     * @return Admin
     */
    public function admin(): Admin
    {
        return Auth::guard(self::ADMIN_GUARD)->user();
    }

    /**
     * Update a user's profile.
     * 
     * @param User $user
     * @param array<string, mixed> $data
     */
    public function update(User $user, array $data): void
    {
        $user->update([
            'name' => $data['first_name'] . ' ' . $data['last_name'] ?? $user->name,
            'mobile' => $data['mobile'] ?? $user->mobile,
            'gender' => $data['gender'] ?? $user->gender,
            'address' => $data['address'] ?? $user->address,
            'country_id' => $countryId = app(CountryRepository::class)->findByIso2Code($data['country'])->id ?? $user->country_id,
            'state_id' => app(CountryRepository::class)->findStateByCode($countryId, $data['state'])->id ?? $user->state_id,
            'city_id' => $data['city'] ?? $user->city_id,
            'zip_code' => $data['zip_code'] ?? $user->zip_code,
            // 'timezone_id' => $data['timezone'] ?? $user->timezone_id,
            'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
        ]);
    }

    /**
     * Create a new user.
     *
     * @param array<string, mixed> $data
     */
    protected function createUser(array $data): void
    {
        User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Create a new admin.
     *
     * @param array<string, mixed> $data
     */
    protected function createAdmin(array $data): void
    {
        Admin::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}