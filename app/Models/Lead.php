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

    // Automatically send notification when created or updated
    protected static function booted()
    {
        // When lead is created
        static::created(function ($lead) {
            $user = User::find($lead->assigned_to);
            $title = 'New Lead Assigned';
            $message = "You have been assigned a new lead: {$lead->first_name} {$lead->last_name}";
            if ($user) {
                $user->notify(new SendNotifications($title,$message,$lead->id));

                  // Notify all admins
                $admins = User::whereHas('roles', function ($q) {
                    $q->where('role_name', 'admin');
                })->get();
                $title = 'Lead Created';
                $message = "A new lead: {$lead->first_name} {$lead->last_name} has been created and assigned to {$user->name}";
                Notification::send($admins, new SendNotifications($title,$message,$lead->id));
            }

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
                  // Notify assigned user
                 $user = User::find($lead->assigned_to);
                if ($user) {
                    $title = 'Lead Qualified';
                    $message = "Lead {$lead->first_name} {$lead->last_name} has been qualified. Contact and Opportunity created and assigned to you.";
                    $lead_id = $lead->id;
                    $user->notify(new SendNotifications($title,$message,$lead_id));
                }

                // Notify all admins
                $admins = User::whereHas('roles', function ($q) {
                    $q->where('role_name', 'admin');
                })->get();
                $title = 'Lead Qualified';
                $message = "Lead {$lead->first_name} {$lead->last_name} has been qualified. Contact and Opportunity created.";
                $lead_id = $lead->id;
                Notification::send($admins, new SendNotifications($title, $message, $lead_id));
            }
        });
    }
}
