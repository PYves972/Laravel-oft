<?php

namespace App\Http\Controllers;

use App\Models\PedagogicalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedagogicalDocumentController extends Controller
{
    public function download(PedagogicalDocument $document)
    {
        $user = auth()->user();

        // Vérifier si le document est public
        if (!$document->is_public) {
            abort(403, 'Ce document n\'est pas disponible au téléchargement.');
        }

        // Vérifier que l'utilisateur est bien inscrit à la formation liée à ce document
        $hasBooked = $user->bookings()
            ->whereHas('trainingSession', function ($query) use ($document) {
                $query->where('training_id', $document->training_id);
            })->exists();

        if (!$hasBooked) {
            abort(403, 'Vous n\'avez pas accès aux documents de cette formation.');
        }

        // Retourner le fichier en téléchargement
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Fichier introuvable sur le serveur.');
        }

        return Storage::disk('public')->download($document->file_path, $document->title);
    }
}
