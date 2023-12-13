<?php

namespace App\Notifications\Bid;

use App\Models\Ad;
use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Ad $ad, protected Bid $bid, protected bool $isAdOwner)
    {
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
                    ->subject('Bid Placed On - ' . $this->ad->title)
                    ->greeting('Hello ' .($this->isAdOwner ? $this->ad->user->name : $this->bid->user->name) . '!')
                    ->linesIf($this->isAdOwner, [
                        'A new bid has been placed on your ad.',
                        'Bid Amount: ' . money($this->bid->amount),
                        'Bidder Name: ' . $this->bid->user->name,
                        'Bidder Email: ' . $this->bid->user->email,
                    ])
                    ->linesIf(!$this->isAdOwner, [
                        'Your bid has been placed successfully.',
                        'Bid Amount: ' . money($this->bid->amount),
                        'Ad Title: ' . $this->ad->title,
                    ])
                    ->action($this->isAdOwner ? 'View Ad' : 'View Bid',  $this->isAdOwner ? route('user.ads.show', $this->ad->slug) : route('user.listing-bids.show', $this->bid->id))
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
