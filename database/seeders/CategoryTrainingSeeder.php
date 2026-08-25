<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Training;
use Illuminate\Database\Seeder;

class CategoryTrainingSeeder extends Seeder
{
    /**
     * Crée la catégorie et les ateliers de l'OFT Atelier.
     */
    public function run(): void
    {
        /*
         * ============================================================
         * CATÉGORIE
         * ============================================================
         */

        $category = Category::updateOrCreate(
            [
                'slug' => 'ateliers',
            ],
            [
                'name' => 'Ateliers',
            ]
        );

        /*
         * ============================================================
         * ATELIERS
         * ============================================================
         */

        $trainings = [
            [
                'title' => 'Broderie',
                'slug' => 'broderie',
                'description' => 'Découvrez les techniques de base de la broderie et réalisez vos premiers ouvrages textiles.',
                'learning_objectives' => "Découvrir les principaux points de broderie.\nApprendre à utiliser le matériel de broderie.\nRéaliser un ouvrage simple.",
                'duration_minutes' => 180,
                'price' => 45.00,
                'capacity' => 5,
                'color' => '#F97316',
            ],
            [
                'title' => 'Couture',
                'slug' => 'couture',
                'description' => 'Apprenez les bases de la couture et familiarisez-vous avec les outils et techniques indispensables.',
                'learning_objectives' => "Découvrir le matériel de couture.\nApprendre les bases de l'assemblage textile.\nRéaliser un ouvrage simple.",
                'duration_minutes' => 180,
                'price' => 45.00,
                'capacity' => 12,
                'color' => '#EAB308',
            ],
            [
                'title' => 'Tricot et crochet',
                'slug' => 'tricot-et-crochet',
                'description' => 'Initiez-vous au tricot et au crochet et découvrez les techniques essentielles pour créer vos propres ouvrages.',
                'learning_objectives' => "Découvrir le matériel nécessaire au tricot et au crochet.\nApprendre les gestes et points de base.\nRéaliser un premier ouvrage.",
                'duration_minutes' => 180,
                'price' => 45.00,
                'capacity' => 7,
                'color' => '#8B5CF6',
            ],
            [
                'title' => 'Tissage',
                'slug' => 'tissage',
                'description' => 'Découvrez les principes du tissage et apprenez à créer des compositions textiles à partir de fils et de matières différentes.',
                'learning_objectives' => "Comprendre les principes du tissage.\nDécouvrir le matériel et les outils.\nRéaliser une première création tissée.",
                'duration_minutes' => 180,
                'price' => 45.00,
                'capacity' => 7,
                'color' => '#EC4899',
            ],
            [
                'title' => 'Teinture',
                'slug' => 'teinture',
                'description' => 'Découvrez les techniques de teinture textile et expérimentez différentes façons de créer des effets et des couleurs.',
                'learning_objectives' => "Découvrir les principes de la teinture textile.\nApprendre à préparer les matières textiles.\nExpérimenter différentes techniques de coloration.",
                'duration_minutes' => 180,
                'price' => 45.00,
                'capacity' => 5,
                'color' => '#14B8A6',
            ],
        ];

        /*
         * ============================================================
         * CRÉATION / MISE À JOUR DES FORMATIONS
         * ============================================================
         */

        foreach ($trainings as $trainingData) {

            $trainingData['category_id'] = $category->id;
            $trainingData['is_active'] = true;

            $training = Training::updateOrCreate(
                [
                    'slug' => $trainingData['slug'],
                ],
                $trainingData
            );

            $this->command->info(
                "Atelier enregistré : {$training->title} - {$training->capacity} places - {$training->color}"
            );
        }

        /*
         * ============================================================
         * RÉSUMÉ
         * ============================================================
         */

        $this->command->newLine();

        $this->command->info(
            'Les 5 ateliers OFT Atelier ont été enregistrés avec succès.'
        );

        $this->command->table(
            [
                'Atelier',
                'Places',
                'Couleur',
            ],
            [
                ['Broderie', '5', '#F97316'],
                ['Couture', '12', '#EAB308'],
                ['Tricot et crochet', '7', '#8B5CF6'],
                ['Tissage', '7', '#EC4899'],
                ['Teinture', '5', '#14B8A6'],
            ]
        );
    }
}
