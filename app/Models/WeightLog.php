<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    protected $fillable = [
    'trainee_id',
    'weight',
    'height',
    'age',
    'gender',
    'bmi_result',
    'bmi_category'
];

}
// Simpan ke database