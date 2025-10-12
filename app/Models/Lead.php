<?php

namespace App\Models;

use App\Notifications\LeadAssignedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Opportunitie ;

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
        return $this->hasMany(Opportunitie::class);
    }

    // Automatically send notification when created or updated
    protected static function booted()
    {
        // When lead is created
        static::created(function ($lead) {
            if ($lead->users) {
                $lead->users->notify(new LeadAssignedNotification($lead));
            }
        });

        // When status is updated to Qualified
        static::updated(function ($lead) {

            if ($lead->isDirty('status') && $lead->status === 'Qualified') {
                // Notify assigned user
                if ($lead->users) {
                    $lead->users->notify(new \App\Notifications\LeadQualifiedNotification($lead));
                }

                // Notify all admins
                $admins = User::whereHas('roles', function ($q) {
                    $q->where('role_name', 'Admin');
                })->get();

                Notification::send($admins, new \App\Notifications\LeadQualifiedNotification($lead));
            }
        });
    }
}
