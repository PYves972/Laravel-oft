<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingSession;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Crée les séances du mardi au samedi.
     *
     * Créneaux :
     * 09h00 → 11h00
     * 11h00 → 13h00
     * 14h00 → 16h00
     */
    public function run(): void
    {
        /*
         * ============================================================
         * RÉCUPÉRATION DES 5 ATELIERS
         * ============================================================
         *
         * On sélectionne uniquement les ateliers concernés
         * par le calendrier.
         */

        $slugs = [
            'broderie',
            'couture',
            'tricot-et-crochet',
            'tissage',
            'teinture',
        ];

        $trainings = Training::whereIn('slug', $slugs)->get();

        if ($trainings->count() !== 5) {
            $this->command->error(
                'Les 5 ateliers attendus n\'ont pas été trouvés.'
            );

            $this->command->info(
                'Lance d’abord CategoryTrainingSeeder.'
            );

            return;
        }

        /*
         * ============================================================
         * SUPPRESSION DES ANCIENNES SÉANCES
         * ============================================================
         *
         * Permet de relancer le seeder sans créer de doublons.
         */

        TrainingSession::query()->delete();

        /*
         * ============================================================
         * CALENDRIER
         * ============================================================
         *
         * On part du lundi de la semaine actuelle.
         *
         * +1 = mardi
         * +2 = mercredi
         * +3 = jeudi
         * +4 = vendredi
         * +5 = samedi
         */

        $monday = Carbon::now()->startOfWeek(Carbon::MONDAY);

        $days = [
            1, // Mardi
            2, // Mercredi
            3, // Jeudi
            4, // Vendredi
            5, // Samedi
        ];

        /*
         * ============================================================
         * CRÉNEAUX
         * ============================================================
         */

        $timeSlots = [
            [
                'start' => '09:00',
                'end' => '11:00',
            ],
            [
                'start' => '11:00',
                'end' => '13:00',
            ],
            [
                'start' => '14:00',
                'end' => '16:00',
            ],
        ];

        /*
         * ============================================================
         * CRÉATION DES SÉANCES
         * ============================================================
         */

        foreach ($days as $day) {

            $date = $monday->copy()->addDays($day);

            foreach ($trainings as $training) {

                foreach ($timeSlots as $slot) {

                    $startAt = Carbon::parse(
                        $date->format('Y-m-d') . ' ' . $slot['start']
                    );

                    $endAt = Carbon::parse(
                        $date->format('Y-m-d') . ' ' . $slot['end']
                    );

                    TrainingSession::create([
                        'training_id' => $training->id,
                        'start_at' => $startAt,
                        'end_at' => $endAt,
                        'capacity_max' => $training->capacity,
                        'status' => 'open',
                    ]);
                }
            }
        }

        /*
         * ============================================================
         * RÉSULTAT
         * ============================================================
         */

        $count = TrainingSession::count();

        $this->command->info(
            "{$count} séances ont été créées avec succès."
        );
    }
}
