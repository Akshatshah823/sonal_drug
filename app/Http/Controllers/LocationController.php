<?php

namespace App\Http\Controllers;
use App\Models\Location;

use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function index()
    {
      $locations = Location::with('user:id,name,email') 
        ->select([
            'id',
            'user_id',
            'latitude',
            'longitude',
            'created_at'
        ])
        ->latest()
        ->get();

        return response()->json($locations);
    }
    public function manage()
{
    return view('attendance_view');
}
}
