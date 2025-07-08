<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documentos')->insert(
            [
                ['tipo_docuemto' => 'CI'],
                ['tipo_docuemto' => 'NIT'],
                ['tipo_docuemto' => 'OTRO']
            ]
        );
    }
}
