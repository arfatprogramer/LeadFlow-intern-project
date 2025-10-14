<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

final class ActivityLogService
{
    public static function log($model, string $type, string $message=""){
        $model->activityLogs()->create([
            'user_id'=>Auth::id(),
            'type'=>$type,
            'message'=>$message,
        ]);
    }

}
