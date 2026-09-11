<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\PedagogicalDocumentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Livewire\TrainingBookingCalendar;
use App\Livewire\ShowAtelier;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

// 1. ACCUEIL & PAGES D'INFORMATION
Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::where('is_published', true)->latest()->take(3)->get();

    return view('welcome', compact('services', 'testimonials'));
})->name('home');

Route::get('/faq', FaqController::class)->name('faq.index');
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/temoignages', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter/subscribe', [SubscriberController::class, 'store'])->name('newsletter.subscribe');

// 2. GRAND CALENDRIER GLOBAL (Planning mensuel de tous les cours)
Route::get('/calendrier', TrainingBookingCalendar::class)->name('training-calendar.index');
Route::get('/calendrier-index', TrainingBookingCalendar::class)->name('web.calendar');

// 3. CATALOGUES D'ATELIERS ET FORMATIONS
Route::get('/formations', [TrainingController::class, 'formations'])->name('trainings.formations');
Route::get('/ateliers', [TrainingController::class, 'workshops'])->name('trainings.workshops');

// 4. DÉTAIL & RÉSERVATION D'UN ATELIER SPÉCIFIQUE (NOUVEAU MODULE DE RÉSERVATION)
// Les routes de réservation individuelle renvoient désormais sur la fiche produit de l'atelier
Route::get('/ateliers/{slug}', [TrainingController::class, 'show'])->name('ateliers.show');
Route::get('/formations/{slug}', [TrainingController::class, 'show'])->name('trainings.show');
Route::get('/calendrier/{training:slug}', [TrainingController::class, 'show'])->name('calendar.show');

// 5. ESPACE CLIENT & TABLEAU DE BORD
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/documents/{document}/download', [PedagogicalDocumentController::class, 'download'])
        ->name('documents.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/sessions/{session}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

// 6. FICHIERS D'IMAGES DU STORAGE
Route::get('/storage/trainings/{filename}', function ($filename) {
    $path = storage_path('app/public/trainings/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

require __DIR__.'/auth.php';
