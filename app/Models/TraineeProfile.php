<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraineeProfile extends Model
{
    protected $fillable = ['user_id', 'gender', 'age', 'height', 'weight', 'trainer_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
