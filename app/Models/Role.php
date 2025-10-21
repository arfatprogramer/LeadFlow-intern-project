<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
     use HasFactory, Notifiable;
     protected $guarded = [];
     protected $hidden = ['created_at', 'updated_at'];



        //Relationship with User model
        public function users()
        {
            return $this->belongsToMany(User::class, 'role_user');
        }

    
}
