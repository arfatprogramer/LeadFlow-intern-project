<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeadQualifiedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $lead;
    
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Lead Qualified: ' . $this->lead->first_name)
            ->line('A lead has been marked as Qualified.')
            ->line('Lead: ' . $this->lead->first_name . ' ' . $this->lead->last_name)
            ->action('View Lead', route('leads.show', $this->lead->id))
            ->line('Please follow up as soon as possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'lead_id' => $this->lead->id,
            'lead_name' => $this->lead->first_name . ' ' . $this->lead->last_name,
            'message' => 'Lead has been marked as Qualified',
        ];
    }
}
