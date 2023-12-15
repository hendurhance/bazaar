<?php

namespace App\Notifications\Payout;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayoutStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Payout $payout)
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
                    ->subject('Payout Status Updated')
                    ->greeting('Hello!, ' . $notifiable->name)
                    ->line('Your payout status has been updated to ' . $this->payout->status->label())
                    ->line('Amount: ' . $this->payout->amount)
                    ->line('Gateway: ' . $this->payout->gateway->label())
                    ->line('Status: ' . $this->payout->status->label())
                    ->line('Payout Method: ' . $this->payout->payoutMethod->account_name . ' - ' . $this->payout->payoutMethod->account_number . ' - ' . $this->payout->payoutMethod->bank_name)
                    ->line('Description: ' . $this->payout->description)
                    ->line('View payout details by clicking the button below.')
                    ->action('View Payout', route('user.payouts.show', $this->payout->pyt_token))
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
