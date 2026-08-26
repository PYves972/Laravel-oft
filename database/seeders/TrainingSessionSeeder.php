<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingSession;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrainingSessionSeeder extends Seeder
{
    public function run(): void
    {
        /*
         * ============================================================
         * RÉCUPÉRATION DES ATELIERS
         * ============================================================
         */

        $trainings = Training::whereIn('slug', [
            'broderie',
            'couture',
            'tricot-et-crochet',
            'tissage',
            'teinture',
        ])->get()->keyBy('slug');

        /*
         * Vérification
         */
        $requiredTrainings = [
            'broderie',
            'couture',
            'tricot-et-crochet',
            'tissage',
            'teinture',
        ];

        foreach ($requiredTrainings as $slug) {
            if (! isset($trainings[$slug])) {
                $this->command->error(
                    "Atelier introuvable : {$slug}"
                );

                return;
            }
        }

        /*
         * ============================================================
         * RÉPARTITION DU CALENDRIER
         * ============================================================
         *
         * Un seul atelier par créneau.
         *
         * Mardi → Samedi
         *
         * 09:00 → 11:00
         * 11:00 → 13:00
         * 14:00 → 16:00
         *
         * Pause : 13:00 → 14:00
         */

        $schedule = [
            'mardi' => [
                ['09:00', '11:00', 'broderie'],
                ['11:00', '13:00', 'couture'],
                ['14:00', '16:00', 'tissage'],
            ],

            'mercredi' => [
                ['09:00', '11:00', 'tricot-et-crochet'],
                ['11:00', '13:00', 'teinture'],
                ['14:00', '16:00', 'broderie'],
            ],

            'jeudi' => [
                ['09:00', '11:00', 'couture'],
                ['11:00', '13:00', 'tissage'],
                ['14:00', '16:00', 'tricot-et-crochet'],
            ],

            'vendredi' => [
                ['09:00', '11:00', 'teinture'],
                ['11:00', '13:00', 'broderie'],
                ['14:00', '16:00', 'couture'],
            ],

            'samedi' => [
                ['09:00', '11:00', 'tissage'],
                ['11:00', '13:00', 'tricot-et-crochet'],
                ['14:00', '16:00', 'teinture'],
            ],
        ];

        /*
         * ============================================================
         * PROCHAINE SEMAINE DE CALENDRIER
         * ============================================================
         *
         * On commence au prochain mardi.
         */

        $date = Carbon::now()->next(Carbon::TUESDAY);

        /*
         * ============================================================
         * CRÉATION DES 15 SÉANCES
         * ============================================================
         */

        foreach ($schedule as $day => $slots) {
            foreach ($slots as [$start, $end, $trainingSlug]) {
                $training = $trainings[$trainingSlug];

                $startAt = $date->copy()->setTimeFromTimeString($start);
                $endAt = $date->copy()->setTimeFromTimeString($end);

                TrainingSession::updateOrCreate(
                    [
                        'start_at' => $startAt,
                    ],
                    [
                        'training_id' => $training->id,
                        'end_at' => $endAt,
                        'capacity_max' => $training->capacity,
                        'status' => 'open',
                    ]
                );

                $this->command->info(
                    "Séance créée : {$training->title} - " .
                    "{$startAt->format('d/m/Y')} " .
                    "{$start} → {$end} - " .
                    "{$training->capacity} places"
                );
            }

            $date->addDay();
        }

        /*
         * ============================================================
         * RÉSUMÉ
         * ============================================================
         */

        $this->command->newLine();

        $this->command->info(
            'Les 15 séances du calendrier ont été créées avec succès.'
        );
    }
}
