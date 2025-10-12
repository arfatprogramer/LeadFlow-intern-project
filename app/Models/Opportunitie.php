<?php

namespace App\Models;

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
}
