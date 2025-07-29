<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage; 
use App\Models\Attendance;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   public function showForm() {
    return view('attendace');
}

public function punch(Request $request) {
    $imageData = $request->image;
    $fileName = 'selfies/' . uniqid() . '.png';
    Storage::disk('public')->put($fileName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));

    Attendance::create([
        'user_id' => auth()->id(),
        'selfie_path' => $fileName,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'punched_at' => now(),
    ]);

    return back()->with('success', 'Attendance punched!');
}
}
