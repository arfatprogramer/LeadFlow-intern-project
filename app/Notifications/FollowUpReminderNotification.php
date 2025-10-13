<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FollowUpReminderNotification extends Notification
{
    use Queueable;

    protected $lead;

    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '🔔 Follow-Up Reminder',
            'message' => "Follow up with lead: {$this->lead->first_name} {$this->lead->last_name}",
            'lead_id' => $this->lead->id,
            'url' => route('leads.show', $this->lead->id),
        ];
    }
}
