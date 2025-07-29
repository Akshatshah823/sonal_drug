<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Attendance;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   public function showForm() {
    return view('attendace');
}

public function punch(Request $request) {

     $validator = Validator::make($request->all(), [
            'image' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

        ]);
         if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }


    $imageData = $request->image;
    $fileName = 'selfies/' . uniqid() . '.png';
    Storage::disk('public')->put($fileName, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));

    $attendance = Attendance::create([
        'user_id' => auth()->id(),
        'selfie_path' => $fileName,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'punched_at' => now(),
    ]);

    return response()->json([
                'success' => true,
                'message' => 'Attendance punched successfully',
                'data' => $attendance
                // 'redirect' => route('attendance.confirmation') // Optional redirect
            ]);

    return back()->with('success', 'Attendance punched!');
}
}
