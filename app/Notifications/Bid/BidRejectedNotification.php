<?php

namespace App\Notifications\Bid;

use App\Models\Ad;
use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidRejectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Ad $ad, protected Bid $bid)
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
                    ->subject('Bid Rejected - ' . $this->ad->title)
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('Your bid has been rejected.')
                    ->line('Accepted Bid Amount: ' . money($this->ad->winningBid->amount))
                    ->line('Sorry, your bid was not accepted. We encourage you to bid on other ads.')
                    ->line('Our live auction is still open. You can bid on other ads by visiting the link below.')
                    ->action('Browse Ads', route('live-auction'))
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
