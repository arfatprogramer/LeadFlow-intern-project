<?php

namespace App\Models;

use App\Notifications\SendNotifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Opportunitie ;
use App\Models\Contact;
use App\Notifications\sendDeleteNotification;
use App\Services\ActivityLogService;
use App\Services\LeadNotificationService;
use Illuminate\Support\Facades\Auth;

class Lead extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function opportunities()
    {
        return $this->hasOne(Opportunitie::class);
    }

    public function contacts()
    {
        return $this->hasOne(Contact::class);
    }

     //this  for Manage Logs
    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class,'loggable')->latest();
    }

    // Automatically send notification when created or updated
    protected static function booted()
    {
        // When lead is created
        static::created(function ($lead) {
            // send Notification 
            $data=[
                'user_title'=>"New Lead Created",
                'user_message'=>"You have been assigned a new lead: {$lead->first_name} {$lead->last_name}",
                'admin_title'=>"",
                "admin_message"=>"A new lead: {$lead->first_name} {$lead->last_name} has been created and assigned to <username>",
            ];
             LeadNotificationService::notifyLeadAssignment($lead,$data);
            //Log data into database 
            $msg="new Lead $lead->first_name $lead->last_name  hase been created ";
            ActivityLogService::log($lead,'Created',$msg);

        });

        // When status is updated to Qualified
        static::updated(function ($lead) {

            if ($lead->isDirty('status') && $lead->status === 'Qualified') {
                // Create Contact
                $contact = Contact::create([
                    'first_name' => $lead->first_name,
                    'last_name'  => $lead->last_name,
                    'email'      => $lead->email,
                    'phone'      => $lead->phone,
                    'source'      => 'Lead',
                    'notes'      => 'Converted from Lead ID: '.$lead->id,
                    'company'    => $lead->company,
                    'lead_id'    => $lead->id,
                    'assigned_to'=> $lead->assigned_to,
                ]);

                // Create Opportunity
                $opportunity = Opportunitie::create([
                    'user_id' => $lead->assigned_to,
                    'lead_id'    => $lead->id,
                    'details'    => "Converted from Lead ID: ".$lead->id,
                    'title'     => 'Opportunity for '.$lead->first_name.' '.$lead->last_name,
                ]);
                  // Notify 
                $data=[
                    'user_title'=>"Lead Qualified",
                    'user_message'=>"Lead {$lead->first_name} {$lead->last_name} has been qualified. Contact and Opportunity created and assigned to you.",
                    'admin_title'=>"Lead Qualified",
                    "admin_message"=>"Lead {$lead->first_name} {$lead->last_name} has been qualified. Contact and Opportunity created.",
                ];
                LeadNotificationService::notifyLeadAssignment($lead,$data);
                //Log data into database 
                $msg="The Lead $lead->first_name $lead->last_name  hase been qualified ";
                ActivityLogService::log($lead,'Status_changed',$msg);
            }

            if ($lead->isDirty('status') && $lead->status === 'Lost') {

                //Log data into database 
                $msg="The Lead $lead->first_name $lead->last_name  hase been lost ";
                ActivityLogService::log($lead,'Status_changed',$msg);

                  // Notify assigned user
                 $data=[
                    'user_title'=>"Lead Lost",
                    'user_message'=>"Lead {$lead->first_name} {$lead->last_name} has been Lost.",
                    'admin_title'=>"Lead Lost",
                    "admin_message"=>"Lead {$lead->first_name} {$lead->last_name} has been Lost.",
                ];
                LeadNotificationService::notifyLeadAssignment($lead,$data);
            }

              if ($lead->isDirty('status') && $lead->status === 'Contacted') {
    
                 $data=[
                    'user_title'=>"Lead Contacted",
                    'user_message'=>"Lead {$lead->first_name} {$lead->last_name} has been Contacted.",
                    'admin_title'=>"Lead Contacted",
                    "admin_message"=>"Lead {$lead->first_name} {$lead->last_name} has been Contacted.",
                ];
                LeadNotificationService::notifyLeadAssignment($lead,$data);
                //Log data into database 
                ActivityLogService::log($lead,'Status_changed',$data['admin_message']);
            }

              if ($lead->isDirty('status') && $lead->status === 'Converted') {
               
                  // Notify assigned user 
                 $data=[
                    'user_title'=>"Lead Converted",
                    'user_message'=>"Lead {$lead->first_name} {$lead->last_name} has been Converted.",
                    'admin_title'=>"Lead Converted",
                    "admin_message"=>"Lead {$lead->first_name} {$lead->last_name} has been Converted.",
                ];
                LeadNotificationService::notifyLeadAssignment($lead,$data);
                //Log data into database 
                ActivityLogService::log($lead,'Status_changed',$data['admin_message']);
            }
        });

        static::deleted(function($lead){
              // Notify assigned user
                 $data=[
                    'user_title'=>"Lead Deleted",
                    'user_message'=>"Lead {$lead->first_name} {$lead->last_name} has been Deleted.",
                    'admin_title'=>"Lead Deleted",
                    "admin_message"=>"Lead {$lead->first_name} {$lead->last_name} has been Deleted.",
                ];
                LeadNotificationService::notifyLeadAssignment($lead,$data);
                //Log data into database 
                ActivityLogService::log($lead,'Status_changed',$data['admin_message']);
        });
    }
}
