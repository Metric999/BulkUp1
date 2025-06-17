<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'feedback_id';

    protected $fillable = ['trainee_id', 'date', 'comment'];

    public function trainee()
    {
        return $this->belongsTo(User::class, 'trainee_id');
    }
}// Simpan ke database
