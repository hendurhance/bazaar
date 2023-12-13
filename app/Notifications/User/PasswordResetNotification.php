<?php

namespace App\Notifications\User;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PasswordResetNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected User|Admin $user, protected string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Reset your password')
                    ->greeting('Hello, ' . $this->user->name)
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset Password', $this->getActionUrl())
                    ->action('Reset Password', route('user.reset-password',  [$this->token]))
                    ->line('If you did not request a password reset, no further action is required.')
                    ->salutation('Regards, ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * Get action url.
     */
    protected function getActionUrl(): string
    {
        if($this->user instanceof User) {
            return route('user.reset-password', [$this->token]);
        }
        if($this->user instanceof Admin) {
            return route('admin.reset-password', [$this->token]);
        }
    }
}
