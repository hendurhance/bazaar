<?php

namespace App\Notifications\Payment;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidPaymentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Payment $payment, protected bool $isPayee)
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
                    ->subject('Bid Payment Confirmation')
                    ->greeting('Hello, ' . $notifiable->name)
                    ->linesIf(!$this->isPayee, [
                        'Your payment for the bid has been confirmed. Bid of ' . money($this->payment->amount) . ' has been paid to the advertiser.',
                        'The Ad you paid for is ' . $this->payment->ad->title . '.',
                        'You can contact the advertiser by email on ' . $this->payment->ad->seller_email . ' or phone on ' . $this->payment->ad->seller_phone . '.',
                    ])
                    ->linesIf($this->isPayee, [
                        'A payment has been made for a bid placed on your Ad. Bid of ' . money($this->payment->amount) . ' has been paid to you.',
                        'The Ad the buyer paid for is ' . $this->payment->ad->title . '. The payment was made by ' . $this->payment->payer->name . '.',
                        'You can contact the buyer by email on ' . $this->payment->payee->email . ' to arrange for the delivery of the item.'
                    ])
                    ->action(...array_values($this->getActionDetails()))
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

    /**
     * Get action details
     * 
     * @return array<string, mixed>
     */
    public function getActionDetails(): array
    {
        return match ($this->isPayee){
            true => [
                'action' => 'View Payment',
                'url' => route('user.payments.show', $this->payment->txn_id),
            ],
            false => [
                'action' => 'Request Payout',
                'url' => route('user.payouts.show', $this->payment->txn_id),
            ],
        };
    }
}
