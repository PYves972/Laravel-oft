<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\GalleryController;
use App\Livewire\TrainingBookingCalendar;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SubscriberController;


Route::post('/newsletter/subscribe', [SubscriberController::class, 'store'])->name('newsletter.subscribe');

// Page d'information & FAQ
Route::get('/faq', FaqController::class)->name('faq.index');

Route::get('/', [TrainingController::class, 'index'])->name('home');
// Accueil
Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::where('is_published', true)->latest()->take(3)->get();

    return view('welcome', compact('services', 'testimonials'));
})->name('home');

// Calendrier direct (accessible après le choix d'une formation ou d'un atelier)
Route::get('/calendrier', TrainingBookingCalendar::class)->name('training-calendar.index');

// Catalogues
Route::get('/formations', [TrainingController::class, 'formations'])->name('trainings.formations');
Route::get('/ateliers', [TrainingController::class, 'workshops'])->name('trainings.workshops');
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');

Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/temoignages', [TestimonialController::class, 'index'])->name('testimonials.index');
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

Route::get('/storage/trainings/{filename}', function ($filename) {
    $path = storage_path('app/public/trainings/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});
require __DIR__.'/auth.php';
