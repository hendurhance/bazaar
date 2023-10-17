<?php

namespace App\Notifications\Payout;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayoutRequestNotification extends Notification
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
                    ->subject('Payout Request')
                    ->greeting('Hello!, ' . $notifiable->name)
                    ->lines([
                        'You have requested a payout for the payment below:',
                        'Payout ID: ' . $this->payout->pyt_token,
                        'Amount: ' . $this->payout->amount,
                        'Fee: ' . $this->payout->fee,
                        'Total: ' . $this->payout->total,
                        'Payout Method: ' . $this->payout->payoutMethod->bank_name,
                        'Account Name: ' . $this->payout->payoutMethod->account_name,
                        'Account Number: ' . $this->payout->payoutMethod->account_number,
                    ])
                    ->line('View payout request details by clicking the button below.')
                    ->action('View Payout Request', route('user.payouts.show', $this->payout->pyt_token))
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
