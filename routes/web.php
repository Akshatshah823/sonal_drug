<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/attendance', [AttendanceController::class, 'showForm'])->name('attendance.form');
    Route::post('/attendance', [AttendanceController::class, 'punch'])->name('attendance.punch');
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/manage', [LocationController::class, 'manage'])->name('locations.manage');

    Route::get('/chat', function () {
    return view('open_ai'); 
});

Route::post('/ask', [AiController::class, 'ask']);

});


require __DIR__.'/auth.php';
