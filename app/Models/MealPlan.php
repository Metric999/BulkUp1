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
];// Simpan ke database
}
