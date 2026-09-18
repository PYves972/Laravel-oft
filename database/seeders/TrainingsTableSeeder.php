<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TrainingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('trainings')->delete();

        \DB::table('trainings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'category_id' => 1,
                'title' => 'Atelier Tricot',
                'type' => 'atelier',
                'image_path' => 'trainings/01M255ZNTJ6GP2C06DYEG29HMF.jpg',
                'slug' => 'atelier-tricot',
                'description' => '<p>Apprenez les mailles de base et réalisez vos premiers ouvrages en laine.</p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '45.00',
                'is_active' => 1,
                'color' => '#10B981',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 08:12:12',
            ),
            1 =>
            array (
                'id' => 2,
                'category_id' => 2,
                'title' => 'Atelier Crochet',
                'type' => 'atelier',
                'image_path' => 'trainings/01M2560W16WR6VXRVJR4X140PE.jpg',
                'slug' => 'atelier-crochet',
                'description' => '<p>Découvrez l’art du crochet et façonnez vos accessoires faits main.</p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '45.00',
                'is_active' => 1,
                'color' => '#3B82F6',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 08:12:51',
            ),
            2 =>
            array (
                'id' => 3,
                'category_id' => 3,
                'title' => 'Atelier Couture',
                'type' => 'formation',
                'image_path' => 'trainings/01M255WT8K7FNA2Q4WV8YVGWDA.jpg',
                'slug' => 'atelier-couture',
                'description' => '<p>Maîtrisez votre machine à coudre et assemblez vos premiers vêtements.</p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '60.00',
                'is_active' => 1,
                'color' => '#8B5CF6',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 08:10:38',
            ),
            3 =>
            array (
                'id' => 4,
                'category_id' => 4,
                'title' => 'Atelier Teinture',
                'type' => 'atelier',
                'image_path' => 'trainings/01M2562XMT4B7C8JB4CRW3FCZZ.avif',
                'slug' => 'atelier-teinture',
                'description' => '<p>Initiez-vous aux techniques de teinture textile naturelle et végétale.</p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '55.00',
                'is_active' => 1,
                'color' => '#EC4899',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 08:13:58',
            ),
            4 =>
            array (
                'id' => 5,
                'category_id' => 5,
                'title' => 'Atelier Broderie',
                'type' => 'atelier',
                'image_path' => 'trainings/01M2563VHC2HVZ67GFQD9PXZ8M.jpg',
                'slug' => 'atelier-broderie',
                'description' => '<p>Explorez les différents points de broderie pour personnaliser vos tissus.</p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '40.00',
                'is_active' => 1,
                'color' => '#F59E0B',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 08:14:28',
            ),
            5 =>
            array (
                'id' => 6,
                'category_id' => 6,
                'title' => 'Atelier Tissage',
                'type' => 'atelier',
                'image_path' => 'trainings/01M25654KSDQA33ZPFTQFM8E0Q.jpg',
                'slug' => 'atelier-tissage',
                'description' => '<p>Créez vos premières pièces tissées sur un métier à tisser manuel.</p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '50.00',
                'is_active' => 1,
                'color' => '#10B981',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 08:15:11',
            ),
            6 =>
            array (
                'id' => 7,
                'category_id' => 3,
                'title' => 'Patronage',
                'type' => 'formation',
                'image_path' => 'trainings/01M256R0F5GQ18PR75MPDBGYT1.jpg',
                'slug' => 'patronage',
                'description' => '<p></p>',
                'cover_image' => NULL,
                'gallery_images' => NULL,
                'prerequisites' => NULL,
                'provided_equipment' => NULL,
                'required_equipment' => NULL,
                'program_steps' => NULL,
                'learning_objectives' => NULL,
                'duration_minutes' => 120,
                'price' => '100.00',
                'is_active' => 1,
                'color' => 'teal',
                'capacity' => 5,
                'materials' => NULL,
                'created_at' => '2026-09-10 08:25:29',
                'updated_at' => '2026-09-10 08:27:00',
            ),
        ));


    }
}
