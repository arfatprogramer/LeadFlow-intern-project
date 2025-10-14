<?php

namespace App\Models;

use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    //this  for Manage Logs
    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class,'loggable')->latest();
    }

    protected static function booted()
    {
        static::created(function($contatc){
            //Log data into database 
            $msg="New Contatct $contatc->first_name $contatc->last_name  hase been created ";
            ActivityLogService::log($contatc,'Created',$msg);
        });

         static::updated(function($contatc){
            $oldStage = $contatc->getOriginal('stage'); // old value
            $newStage = $contatc->status;                // new value
             $msg = "status of Contatc '{$contatc->title}' has been changed from '{$oldStage}' to '{$newStage}'.";   
            ActivityLogService::log($contatc,'Created',$msg);
        });

        static::deleted(function($contatc){
            $msg="An Contacts $contatc->title hase been Deleted ";
            ActivityLogService::log($contatc,'Status_changed',$msg);
        });
    }

    
}
