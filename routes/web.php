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
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtelierController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/setup-admin', function () {
    $user = User::updateOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]
    );

    return "Le compte Admin ({$user->email}) a été créé/mis à jour avec le mot de passe 'password' et le rôle admin !";
});
// 1. ACCUEIL & PAGES D'INFORMATION
Route::get('/', function () {
    $services = Service::all();
    $testimonials = Testimonial::where('is_published', true)->latest()->take(3)->get();

    // Récupération du dernier événement actif dont la date n'est pas dépassée
    $annonce = Event::where('is_active', true)
                    ->where(function($query) {
                        $query->whereNull('event_date')
                              ->orWhere('event_date', '>=', now()->startOfDay());
                    })
                    ->latest()
                    ->first();

    return view('welcome', compact('services', 'testimonials', 'annonce'));
})->name('home');

Route::get('/display-image/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
        abort(404);
    }

    $file = file_get_contents($fullPath);
    $type = mime_content_type($fullPath);

    return response($file, 200)->header("Content-Type", $type);
})->where('path', '.*')->name('image.display');

// Route pour les Mentions Légales
Route::view('/mentions-legales', 'legal.mentions-legales')->name('legal.mentions');

// Route pour la Politique de Confidentialité
Route::view('/politique-de-confidentialite', 'legal.privacy-policy')->name('legal.privacy');
Route::get('/a-propos-atelier', [AtelierController::class, 'show'])->name('atelier.about');

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

// 4. DÉTAIL & RÉSERVATION D'UN ATELIER SPÉCIFIQUE
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

Route::get('/make-me-admin', function () {
    $user = \App\Models\User::where('email', 'votre-vrai-email@domaine.com')->first();

    if ($user) {
        $user->update(['is_admin' => true]);
        return "Succès : L'utilisateur {$user->email} est désormais Administrateur !";
    }

    return "Utilisateur introuvable.";
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
