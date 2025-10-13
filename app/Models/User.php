<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $appends = ['role_names'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Relationship with Role model

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'assigned_to');
    }
   public function opportunities()
    {
        return $this->hasMany(Opportunitie::class, 'user_id');
    }

    public function constacts()
    {
        return $this->hasMany(Contact::class, 'assigned_to');
    }

    // Accessor: Returns only an array of role names
    protected function roleNames(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->roles->pluck('role_name')->toArray()
        );
    }
}
