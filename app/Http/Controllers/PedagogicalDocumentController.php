<?php

namespace App\Http\Controllers;

use App\Models\PedagogicalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PedagogicalDocumentController extends Controller
{
    /**
     * Télécharge un document pédagogique de manière sécurisée (RM-28).
     */
    public function download(PedagogicalDocument $document): BinaryFileResponse
    {
        $user = Auth::user();

        // 1. Si le document n'est pas marqué comme public, vérifier les droits d'accès
        if (! $document->is_public) {

            // Vérifier si l'utilisateur possède une réservation confirmée pour la formation associée (RM-28)
            $hasConfirmedBooking = $user->bookings()
                ->where('status', 'confirmed')
                ->whereHas('trainingSession', function ($query) use ($document) {
                    $query->where('training_id', $document->training_id);
                })
                ->exists();

            if (! $hasConfirmedBooking) {
                abort(403, 'Accès non autorisé. Vous devez être inscrit à cette formation pour télécharger ce document.');
            }
        }

        // 2. Vérification de l'existence physique du fichier dans le stockage local/S3
        if (! Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Le fichier demandé est introuvable sur le serveur.');
        }

        // 3. Servir le fichier en téléchargement
        return response()->download(
            Storage::disk('public')->path($document->file_path),
            $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION)
        );
    }
}
