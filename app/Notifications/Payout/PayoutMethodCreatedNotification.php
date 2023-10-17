<?php

namespace App\Notifications\Payout;

use App\Models\PayoutMethod;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayoutMethodCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected PayoutMethod $payoutMethod)
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
                    ->subject('Payout Method Created')
                    ->greeting('Hello!, ' . $notifiable->name)
                    ->line('You have successfully created a payout method with the details below:')
                    ->line('Bank Name: ' . $this->payoutMethod->bank_name)
                    ->line('Account Name: ' . $this->payoutMethod->account_name)
                    ->line('Account Number: ' . $this->payoutMethod->account_number)
                    ->line('By creating a payout method, you can request a payout that will be sent to the payout method you created.')
                    ->line('View payout method details by clicking the button below.')
                    ->action('View Payout Methods', route('user.payout-methods.index'))
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
