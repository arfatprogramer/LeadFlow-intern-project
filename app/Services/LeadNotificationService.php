<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendNotifications;

class LeadNotificationService
{
    /**
     * Static method to notify assigned user and admins.
     */
    public static function notifyLeadAssignment($lead,$data)
    {
        $assignedUser = User::find($lead->assigned_to);
        if ($assignedUser) {
            $assignedUser->notify(new SendNotifications( $data['user_title'], $data['user_message'], $lead->id));

            // Notify all admins
            $admins = User::whereHas('roles', function ($q) {
                $q->where('role_name', 'admin');
            })->get();

            $title = $data['admin_message'];
            $message = str_replace('<username>',"$assignedUser->name", $data['admin_message']);;
            Notification::send($admins, new SendNotifications($title, $message, $lead->id));
        }
    }
}
