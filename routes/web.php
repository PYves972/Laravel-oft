<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Livewire\TrainingBookingCalendar;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

// Accueil
Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::all();
    return view('welcome', compact('services', 'testimonials'));
})->name('home');

// Calendrier direct (accessible après le choix d'une formation ou d'un atelier)
Route::get('/calendrier', TrainingBookingCalendar::class)->name('training-calendar.index');

// Catalogues
Route::get('/formations', [TrainingController::class, 'formations'])->name('trainings.formations');
Route::get('/ateliers', [TrainingController::class, 'workshops'])->name('trainings.workshops');
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');

// Contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Dashboard
Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Espace Authentifié
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/sessions/{session}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

require __DIR__.'/auth.php';
