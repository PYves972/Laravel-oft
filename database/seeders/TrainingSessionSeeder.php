<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\TrainingSession;
use Carbon\Carbon;

class TrainingSessionSeeder extends Seeder
{
    public function run(): void
    {
        // Les 3 créneaux horaires quotidiens
        $timeSlots = [
            ['start' => '09:00:00', 'end' => '11:00:00'],
            ['start' => '11:00:00', 'end' => '13:00:00'],
            ['start' => '14:00:00', 'end' => '16:00:00'],
        ];

        // Quotas de places selon le type d'atelier
        $seatsMap = [
            'tricot'   => 7,
            'crochet'  => 7,
            'couture'  => 12,
            'teinture' => 5,
            'broderie' => 6,
            'tissage'  => 7,
        ];

        $trainings = Training::all();

        // Période de génération : du début à la fin du mois courant
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        foreach ($trainings as $training) {
            $titleKey = mb_strtolower($training->title ?? $training->name ?? '');

            // Détermination du nombre de places par défaut
            $seats = 7;
            foreach ($seatsMap as $key => $capacity) {
                if (str_contains($titleKey, $key)) {
                    $seats = $capacity;
                    break;
                }
            }

            $currentDate = $startDate->copy();
            while ($currentDate->lte($endDate)) {
                // Filtrer du Mardi (2) au Samedi (6)
                if (in_array($currentDate->dayOfWeek, [2, 3, 4, 5, 6])) {
                    foreach ($timeSlots as $slot) {
                        $startsAt = $currentDate->format('Y-m-d') . ' ' . $slot['start'];
                        $endsAt = $currentDate->format('Y-m-d') . ' ' . $slot['end'];

                        TrainingSession::firstOrCreate(
                            [
                                'training_id' => $training->id,
                                'starts_at'   => $startsAt,
                            ],
                            [
                                'ends_at'  => $endsAt,
                                'capacity' => $seats,
                                'status'   => 'open',
                            ]
                        );
                    }
                }
                $currentDate->addDay();
            }
        }
    }
}
