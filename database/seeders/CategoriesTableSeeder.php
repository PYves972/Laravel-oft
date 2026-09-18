<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Tricot',
                'slug' => 'tricot',
                'description' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 07:26:34',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Crochet',
                'slug' => 'crochet',
                'description' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 07:26:34',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Couture',
                'slug' => 'couture',
                'description' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 07:26:34',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Teinture',
                'slug' => 'teinture',
                'description' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 07:26:34',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Broderie',
                'slug' => 'broderie',
                'description' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 07:26:34',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Tissage',
                'slug' => 'tissage',
                'description' => NULL,
                'created_at' => '2026-09-10 07:26:34',
                'updated_at' => '2026-09-10 07:26:34',
            ),
        ));


    }
}
