<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['judul', 'pesan', 'tanggal'];
    public function trainee()
{
    return $this->belongsTo(User::class, 'trainee_id');
}
// Simpan ke database
}