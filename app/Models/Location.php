<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
     protected $table = 'attendances'; 
    
    protected $fillable = [
        'latitude',
        'longitude',
        'user_id'
    ];


     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
