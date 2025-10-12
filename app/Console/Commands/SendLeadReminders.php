<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Notifications\LeadFollowUpReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendLeadReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-lead-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
   protected $description = 'Send follow-up reminders to sales agents';

    public function handle()
    {
        $now = Carbon::now();

        $leads = Lead::whereDate('follow_up_date', $now->toDateString())
                     ->whereTime('reminder_time', '<=', $now->format('H:i'))
                     ->where('reminder_sent', false)
                     ->get();

        foreach ($leads as $lead) {
            $lead->assignedUser?->notify(new LeadFollowUpReminder($lead));
            $lead->update(['reminder_sent' => true]);
        }

        $this->info('Reminders sent: ' . $leads->count());
    }
}
