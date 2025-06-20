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
        'trainer_id', // Trainer ID di sini akan merujuk ke users.id dari trainer
    ];

    /**
     * Get the user that owns the trainee profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trainer (User model) that this trainee is assigned to.
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    /**
     * Get the workouts for the trainee profile.
     * workouts.trainee_id merujuk ke trainee_profiles.id
     */
    public function workouts()
    {
        return $this->hasMany(Workout::class, 'trainee_id', 'id');
    }

    /**
     * Get the meal plans for the trainee profile.
     * meal_plans.trainee_id merujuk ke trainee_profiles.id
     */
    public function mealplans() // Perhatikan huruf kecil 'p' untuk konsistensi
    {
        return $this->hasMany(MealPlan::class, 'trainee_id', 'id');
    }

    /**
     * Get the progress submissions for the trainee profile.
     * progress_submissions.trainee_id merujuk ke trainee_profiles.id
     */
    public function progressSubmissions()
    {
        return $this->hasMany(ProgressSubmission::class, 'trainee_id', 'id');
    }
}