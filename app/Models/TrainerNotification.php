<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Simpan ke database
class TrainerNotification extends Model
{
    protected $fillable = [
        'user_id',
        'sarapan',
        'waktu_sarapan',
        'makan_siang',
        'waktu_makan_siang',
        'tidur',
        'waktu_tidur',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
