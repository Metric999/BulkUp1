<?php

namespace App\Models;
use App\Models\TraineeProfile;
use Illuminate\Database\Eloquent\Model;

class ProgressSubmission extends Model
{
    protected $fillable = ['trainee_id', 'workout_id', 'meal_plan_id', 'submitted_at'];
    

    public function trainee()
    {
        return $this->belongsTo(TraineeProfile::class, 'trainee_id');
    }
    public function traineeProfile()
    {
        return $this->hasOne(TraineeProfile::class, 'user_id');
    }

}

