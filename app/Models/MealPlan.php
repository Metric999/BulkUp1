<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id',
        'trainee_id',
        'date',
        'time',
        'type',
        'meal_name',
        'calories',
        'note'
    ];

    /**
     * Get the trainer (User model) that owns the meal plan.
     * meal_plans.trainer_id merujuk ke users.id
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

    /**
     * Get the trainee profile that owns the meal plan.
     * meal_plans.trainee_id merujuk ke trainee_profiles.id
     */
    public function trainee()
    {
        return $this->belongsTo(TraineeProfile::class, 'trainee_id', 'id'); // <-- BERUBAH
    }
}