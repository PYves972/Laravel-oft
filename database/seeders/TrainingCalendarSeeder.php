<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Training;
use Illuminate\Support\Str;

class CategoryTrainingSeeder extends Seeder
{
    public function run(): void
    {
        $workshops = [
            [
                'title' => 'Atelier Tricot',
                'category_name' => 'Tricot',
                'price' => 45.00,
                'duration' => '2h00',
                'is_active' => true,
            ],
            [
                'title' => 'Atelier Crochet',
                'category_name' => 'Crochet',
                'price' => 45.00,
                'duration' => '2h00',
                'is_active' => true,
            ],
            [
                'title' => 'Atelier Couture',
                'category_name' => 'Couture',
                'price' => 60.00,
                'duration' => '2h00',
                'is_active' => true,
            ],
            [
                'title' => 'Atelier Teinture',
                'category_name' => 'Teinture',
                'price' => 55.00,
                'duration' => '2h00',
                'is_active' => true,
            ],
            [
                'title' => 'Atelier Broderie',
                'category_name' => 'Broderie',
                'price' => 40.00,
                'duration' => '2h00',
                'is_active' => true,
            ],
            [
                'title' => 'Atelier Tissage',
                'category_name' => 'Tissage',
                'price' => 50.00,
                'duration' => '2h00',
                'is_active' => true,
            ],
        ];

        foreach ($workshops as $workshop) {
            // 1. Création ou récupération de la catégorie
            $category = Category::firstOrCreate(
                ['name' => $workshop['category_name']],
                ['slug' => Str::slug($workshop['category_name'])]
            );

            // 2. Création de l'atelier lié à la catégorie
            Training::firstOrCreate(
                ['title' => $workshop['title']],
                [
                    'category_id' => $category->id,
                    'price' => $workshop['price'],
                    'duration' => $workshop['duration'],
                    'is_active' => $workshop['is_active'],
                ]
            );
        }
    }
}
