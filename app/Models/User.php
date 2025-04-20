<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
