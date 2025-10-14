<?php

namespace App\Models;

use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Opportunitie extends Model
{
    /** @use HasFactory<\Database\Factories\OpportunitieFactory> */
  
    use HasFactory, SoftDeletes, Notifiable;
    protected $guarded = [];

    public function lead() 
    { 
        return $this->belongsTo(Lead::class); 
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class,'loggable')->latest();
    }


    public static function booted()
    {
        static::created(function($opportunity){

            //Log data into database 
            $msg="new Opertunity $opportunity->title  hase been Created ";    
            ActivityLogService::log($opportunity,'Created',$msg);

        });

        static::updated(function($opportunity){
            $oldStage = $opportunity->getOriginal('stage'); // old value
            $newStage = $opportunity->stage;                // new value
             $msg = "Stage of Opportunity '{$opportunity->title}' has been changed from '{$oldStage}' to '{$newStage}'.";   
            ActivityLogService::log($opportunity,'Created',$msg);
        });
        
        static::deleted(function($opportunity){
            //Log data into database 
            $msg="An Opportunity $opportunity->title hase been Deleted ";
            ActivityLogService::log($opportunity,'Status_changed',$msg);
        });
    }
}
