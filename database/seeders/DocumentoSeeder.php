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
                ['tipo_documento' => 'Cedula de identidad'],
                ['tipo_documento' => 'Cédula de Extranjería'],
                ['tipo_documento' => 'Pasaporte'],
                ['tipo_documento' => 'Licencia de Conducción'],
                ['tipo_documento' => 'NIT'],
            ]
        );
    }
}
