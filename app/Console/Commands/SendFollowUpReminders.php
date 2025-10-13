<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lead;
use App\Notifications\FollowUpReminderNotification;
use Carbon\Carbon;

class SendFollowUpReminders extends Command
{
    protected $signature = 'reminders:send-followups';
    protected $description = 'Send follow-up reminders to sales agents';

    public function handle()
    {
        $today = Carbon::today();

        $leads = Lead::with('users')->whereDate('follow_up_date', '<=', $today)
            ->whereNotNull('assigned_to')
            ->get();
            
            
            foreach ($leads as $lead) {
            $lead->users?->notify(new FollowUpReminderNotification($lead));

        }

        $this->info('✅ Follow-up reminders sent successfully.');
    }
}
