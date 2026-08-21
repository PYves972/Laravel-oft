<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;

// Catalogue des formations
Route::get('/formations', [TrainingController::class, 'index'])->name('trainings.index');

// Fiche détaillée d'une formation
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');
Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::all();

    return view('welcome', compact('services', 'testimonials'));
});

// Route de contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// En bas de web.php
Route::get('/formations', [TrainingController::class, 'index'])->name('trainings.index');
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');
require __DIR__.'/auth.php';
