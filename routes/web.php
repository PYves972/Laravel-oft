<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingCalendarController;
use App\Http\Controllers\DashboardController;
// ========================================
// ACCUEIL
// ========================================

Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::all();

    return view('welcome', compact('services', 'testimonials'));
});


// ========================================
// CATALOGUE DES FORMATIONS
// ========================================

Route::get('/formations', [TrainingController::class, 'index'])
    ->name('trainings.index');

Route::get('/formations/{slug}', [TrainingController::class, 'show'])
    ->name('trainings.show');


// ========================================
// CONTACT
// ========================================

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');


// ========================================
// DASHBOARD
// ========================================



Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ========================================
// ESPACE AUTHENTIFIE
// ========================================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::post('/sessions/{session}/book', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::delete('/bookings/{booking}', [BookingController::class, 'cancel'])
        ->name('bookings.cancel');

     Route::get('/calendrier', [TrainingCalendarController::class, 'index'])
    ->name('training-calendar.index');
});


require __DIR__.'/auth.php';
