<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcas')->insert(
            [
                ['caracteristica_id' => '1'],
                ['caracteristica_id' => '2'],
                ['caracteristica_id' => '3'],
                ['caracteristica_id' => '4'],
                ['caracteristica_id' => '5'],
                ['caracteristica_id' => '6'],
                ['caracteristica_id' => '7'],
                ['caracteristica_id' => '8'],
                ['caracteristica_id' => '9'],
                ['caracteristica_id' => '10'],
                ['caracteristica_id' => '11'],
                ['caracteristica_id' => '12'],
                ['caracteristica_id' => '13'],
                ['caracteristica_id' => '14'],
                ['caracteristica_id' => '15'],
                ['caracteristica_id' => '16'],
                ['caracteristica_id' => '17'],
                ['caracteristica_id' => '18'],
                ['caracteristica_id' => '19'],
                ['caracteristica_id' => '20'],
            ]
        );
    }
}
