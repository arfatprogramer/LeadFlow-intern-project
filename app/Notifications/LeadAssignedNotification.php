<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class LeadAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $lead;

    public function __construct($lead)
    {
        $this->lead = $lead;
        
    }

    // Use database notifications
    public function via($notifiable)
    {
        return ['database'];
    }

    // Store in database
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Lead Assigned',
            'message' => "You have been assigned a new lead: {$this->lead->first_name} {$this->lead->last_name}",
            'lead_id' => $this->lead->id,
        ];
    }
}
