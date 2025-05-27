<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'name',
        'gender',
        'dob',
        'height',
        'weight',
        'about',
        'photo',
        'profile_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
    return $this->hasOne(TraineeProfile::class);
    }

    public function trainerProfile()
    {
    return $this->hasOne(TrainerProfile::class);
    }
}

