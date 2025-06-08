<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraineeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'age',
        'height',
        'weight',
        'photo',
        'trainer_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function workouts()
    {
    return $this->hasMany(Workout::class, 'trainee_id');
    }

    public function mealplans()
    {
    return $this->hasMany(mealplan::class, 'trainee_id');
    }

    public function progressSubmissions()
    {
    return $this->hasMany(ProgressSubmission::class, 'trainee_id');
    }
}

