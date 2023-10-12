<?php

namespace App\Notifications\Ad;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Ad $ad)
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
                    ->subject(`New Ad created: {$this->ad->title}`)
                    ->greeting('Hello, ' . $this->ad->seller_name)
                    ->line('Your ad has been created successfully, it will be reviewed by our team and published shortly.')
                    ->lines([
                        'Title: ' . $this->ad->title ?? 'N/A',
                        'Description: ' . strip_tags($this->ad->description) ?? 'N/A',
                        'Price: ' . money($this->ad->price) ?? 'N/A',
                        'Category: ' . $this->ad->category->name ?? 'N/A',
                        'Subcategory: ' . $this->ad->subcategory->name ?? 'N/A',
                        'Country: ' . $this->ad->country->name ?? 'N/A',
                        'State: ' . $this->ad->state->name ?? 'N/A',
                        'City: ' . $this->ad->city->name ?? 'N/A',
                    ])
                    ->line('If you have not created this ad, please contact us immediately.')
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
