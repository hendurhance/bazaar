<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected User $user)
    {
        $this->user = $user;
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
                    ->subject('Welcome to ' . config('app.name'))
                    ->greeting('Hello, ' . $this->user->name)
                    ->line('Welcome to ' . config('app.name') . '.')
                    ->line('We are a global marketplace offering a wide variety of products from local retailers around the world on auction.')
                    ->line('Think of us as the "eBay" of the future, where you can buy and sell products on auction at the best prices.')
                    ->line('We are excited to have you join us and we look forward to seeing you around.')
                    ->action('Visit ' . config('app.name'), route('user.dashboard'))
                    ->line('Thank you for using our application!')
                    ->line('If you did not create an account, no further action is required.')
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
}
