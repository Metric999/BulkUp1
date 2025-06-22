<?php

namespace App\Models;
use App\Models\TraineeProfile;
use Illuminate\Database\Eloquent\Model;

class ProgressSubmission extends Model
{
    protected $fillable = ['trainee_id', 'workout_id', 'meal_id', 'submitted_at'];

    public function trainee()
    {
        return $this->belongsTo(TraineeProfile::class, 'trainee_id');
    }

    // Jika tidak digunakan, relasi berikut bisa dihapus
    public function traineeProfile()
    {
        return $this->belongsTo(TraineeProfile::class, 'trainee_id');
    }
}

