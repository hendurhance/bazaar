<?php

namespace App\Notifications\Ad;

use App\Enums\AdStatus;
use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdStatusUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Ad $ad)
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
                    ->subject(`Ad Status Updated: {$this->ad->title}`)
                    ->greeting('Hello, ' . $this->ad->seller_name)
                    ->line('Your ad has been reviewed by our team and the status has been updated to ' . $this->ad->status->label() . '.')
                    ->lineIf($this->ad->status === AdStatus::PUBLISHED, 'Your ad is now live and visible to everyone. You can view your ad by clicking the button below.')
                    ->action('View Ad', route('auction-details', $this->ad->slug))
                    ->lineIf($this->ad->status === AdStatus::REJECTED, 'Your ad has been rejected by our team. Please contact us for more information.')
                    ->lineIf($this->ad->status === AdStatus::PENDING, 'Your ad is currently pending review by our team. You will be notified once the review is complete.')
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
