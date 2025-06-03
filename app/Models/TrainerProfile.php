<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'dob',
        'height',
        'weight',
        'about',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainees()
    {
    return $this->hasMany(TraineeProfile::class, 'trainer_id', 'id'); // trainer_profiles.id
    }
}
