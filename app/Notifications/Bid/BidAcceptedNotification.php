<?php

namespace App\Notifications\Bid;

use App\Models\Ad;
use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidAcceptedNotification extends Notification
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
                    ->subject('Bid Accepted - ' . $this->ad->title)
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('Your bid has been accepted.')
                    ->line('Bid Amount: ' . money($this->bid->amount))
                    ->line('Ad Title: ' . $this->ad->title)
                    ->line('You can contact the ad owner using the following details.')
                    ->line('Name: ' . $this->ad->user->name)
                    ->line('Email: ' . $this->ad->user->email)
                    ->line('Phone: ' . $this->ad->user->phone)
                    ->action('View Ad', route('user.listing-bids.show', $this->bid->id))
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
