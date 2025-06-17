<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\TraineeProfile;
use App\Models\TrainerProfile;


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
// Simpan ke database
    public function traineeProfile()
    {
    return $this->hasOne(TraineeProfile::class);
    }
    public function trainerProfile()
    {
    return $this->hasOne(TrainerProfile::class);
    }

    public function getProfileAttribute()
    {
    return $this->role === 'trainer' ? $this->trainerProfile : $this->traineeProfile;
    }

    public function trainees()
    {
    return $this->hasMany(User::class, 'trainer_id');
    }
    public function notificationSetting()
    {
    return $this->hasOne(TrainerNotification::class);
    }
    public function mealPlans()
{
    return $this->hasMany(MealPlan::class, 'trainee_id');
}



}

