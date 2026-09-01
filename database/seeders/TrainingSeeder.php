<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\TrainingSession;
use Carbon\Carbon;

class TrainingSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Définir une liste de couleurs pour vos ateliers
        $colors = ['#10B981', '#3B82F6', '#8B5CF6', '#EC4899', '#F59E0B'];

        // 2. Mettre à jour les ateliers existants avec des couleurs et créer le cours exemple si nécessaire
        $trainings = Training::all();

        if ($trainings->isEmpty()) {
            $training = Training::create([
                'title' => 'Bombers Femme',
                'color' => '#10B981',
                'price' => 109.00,
                'duration_minutes' => 360,
                'description' => 'Apprenez à coudre un bombers personnalisé.',
            ]);
            $trainings = collect([$training]);
        } else {
            foreach ($trainings as $index => $t) {
                $t->update([
                    'color' => $colors[$index % count($colors)],
                ]);
            }
        }

        // 3. Ajouter des créneaux de test sur les prochains mois pour le premier atelier
        $firstTraining = $trainings->first();

        $dates = [
            now()->setDate(2026, 9, 4)->setTime(10, 0),
            now()->setDate(2026, 9, 15)->setTime(14, 0),
            now()->setDate(2026, 10, 2)->setTime(10, 0),
        ];

        foreach ($dates as $date) {
            TrainingSession::firstOrCreate([
                'training_id' => $firstTraining->id,
                'starts_at' => $date,
            ], [
                'ends_at' => (clone $date)->addHours(6),
                'capacity' => 6,
                'status' => 'open',
            ]);
        }
    }
}
