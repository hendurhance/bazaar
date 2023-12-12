<?php

namespace App\Notifications\Support;

use App\Models\Support;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportTicketNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Support $support)
    {
        //
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
            ->subject('Updated: Support ticket')
            ->line('Your support ticket has been updated.')
            ->line('Subject: ' . strip_tags($this->support->subject))
            ->line('Message: ' . strip_tags($this->support->message))
            ->line('Status: ' . $this->support->status->label())
            ->line('Assigned to: ' . $this->support->admin->name)
            ->line('Response: ' . strip_tags($this->support->response))
            ->salutation('Thank you for using ' . config('app.name') . '!');
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
