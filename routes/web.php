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
use App\Livewire\UserDashboard;
use App\Http\Controllers\PedagogicalDocumentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/documents/{document}/download', [PedagogicalDocumentController::class, 'download'])
        ->name('documents.download');
});

Route::post('/newsletter/subscribe', [SubscriberController::class, 'store'])->name('newsletter.subscribe');

// Page d'information & FAQ
Route::get('/faq', FaqController::class)->name('faq.index');

// Accueil
Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::where('is_published', true)->latest()->take(3)->get();

    return view('welcome', compact('services', 'testimonials'));
})->name('home');

// Calendrier (Ajout de l'alias 'training-calendar.index' attendu par Blade)
// Route principale du calendrier avec alias pour éviter tout conflit de nom
Route::get('/calendrier', TrainingBookingCalendar::class)->name('training-calendar.index');
Route::get('/calendrier-index', TrainingBookingCalendar::class)->name('web.calendar');

Route::get('/calendrier/{training}', [BookingController::class, 'showCalendar'])->name('calendar.show');

// Dashboard (Utiliser DashboardController au lieu de la closure anonyme)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
// Catalogues
Route::get('/formations', [TrainingController::class, 'formations'])->name('trainings.formations');
Route::get('/ateliers', [TrainingController::class, 'workshops'])->name('trainings.workshops');
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');

Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/temoignages', [TestimonialController::class, 'index'])->name('testimonials.index');
// Contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


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
