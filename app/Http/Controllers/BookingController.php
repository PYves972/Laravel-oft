<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TrainingSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Réserver une place pour une séance.
     */
    public function store(TrainingSession $session): RedirectResponse
    {
        try {
            DB::transaction(function () use ($session) {

                /*
                 * On verrouille la séance pendant la réservation.
                 * Cela évite que deux utilisateurs prennent
                 * simultanément la dernière place.
                 */
                $session = TrainingSession::query()
                    ->lockForUpdate()
                    ->findOrFail($session->id);

                /*
                 * Une séance annulée ne peut pas être réservée.
                 */
                if ($session->status === 'cancelled') {
                    throw new \RuntimeException(
                        'Cette séance a été annulée et n’est plus disponible.'
                    );
                }

                /*
                 * On compte uniquement les réservations confirmées.
                 */
                $confirmedBookings = Booking::query()
                    ->where('training_session_id', $session->id)
                    ->where('status', 'confirmed')
                    ->count();

                /*
                 * Vérifier qu'il reste une place.
                 */
                if ($confirmedBookings >= $session->capacity_max) {
                    $session->update([
                        'status' => 'full',
                    ]);

                    throw new \RuntimeException(
                        'Désolé, cette séance est déjà complète.'
                    );
                }

                /*
                 * Chercher une réservation existante de cet utilisateur.
                 *
                 * IMPORTANT :
                 * bookings possède une contrainte unique sur
                 * user_id + training_session_id.
                 *
                 * On ne crée donc pas une deuxième ligne si
                 * l'utilisateur avait auparavant annulé sa réservation.
                 */
                $booking = Booking::query()
                    ->where('user_id', Auth::id())
                    ->where('training_session_id', $session->id)
                    ->first();

                /*
                 * Une réservation confirmée existe déjà.
                 */
                if ($booking && $booking->status === 'confirmed') {
                    throw new \RuntimeException(
                        'Vous êtes déjà inscrit à cette séance.'
                    );
                }

                /*
                 * Si une ancienne réservation était annulée,
                 * on la réactive.
                 */
                if ($booking && $booking->status === 'cancelled') {

                    $booking->update([
                        'status' => 'confirmed',
                    ]);

                } else {

                    /*
                     * Première réservation de cet utilisateur
                     * pour cette séance.
                     */
                    Booking::create([
                        'user_id' => Auth::id(),
                        'training_session_id' => $session->id,
                        'status' => 'confirmed',
                    ]);
                }

                /*
                 * Recompter après la réservation.
                 */
                $confirmedBookings++;

                /*
                 * Si c'était la dernière place,
                 * la séance devient complète.
                 */
                if ($confirmedBookings >= $session->capacity_max) {
                    $session->update([
                        'status' => 'full',
                    ]);
                } else {
                    $session->update([
                        'status' => 'open',
                    ]);
                }
            });

            return back()->with(
                'success',
                'Votre inscription à la séance a bien été enregistrée !'
            );

        } catch (\RuntimeException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }


    /**
     * Annuler une réservation.
     */
    public function cancel(Booking $booking): RedirectResponse
    {
        /*
         * Un utilisateur ne peut annuler que sa propre réservation.
         */
        abort_unless(
            $booking->user_id === Auth::id(),
            403
        );

        /*
         * Si la réservation est déjà annulée.
         */
        if ($booking->status === 'cancelled') {
            return back()->with(
                'error',
                'Cette réservation est déjà annulée.'
            );
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        /*
         * Une place vient d'être libérée.
         */
        $session = $booking->trainingSession;

        if ($session->status === 'full') {
            $session->update([
                'status' => 'open',
            ]);
        }

        return back()->with(
            'success',
            'Votre réservation a bien été annulée.'
        );
    }
}
