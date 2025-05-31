<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id',
        'trainer_id',
        'day',
        'date',
        'name',
        'kategori',
        'difficult',
        'reps',
        'videoUrl'
    ];

    // Relasi ke User
    public function trainee()
    {
        return $this->belongsTo(User::class, 'trainee_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
