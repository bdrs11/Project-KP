<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama' => 'Atribut'],
            ['nama' => 'ATK'],
            ['nama' => 'Makanan Ringan'],
        ];

        DB::table('categories')->insert($categories);
    }
}
