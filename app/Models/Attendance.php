<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     protected $fillable = [
        'user_id',
        'selfie_path',
        'latitude',
        'longitude',
        'punched_at',
    ];
}
