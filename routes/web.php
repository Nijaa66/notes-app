<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect root to notes index
Route::get('/', function () {
    return redirect()->route('notes.index');
});

// Notes CRUD routes (only for logged-in users)
Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class);
});

// Dashboard route (optional, can redirect to notes as well)
Route::get('/dashboard', function () {
    return redirect()->route('notes.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (default Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breeze authentication routes
require __DIR__ . '/auth.php';
