<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //orden al llamar nuestros seeder's es importante!!!!!

        //comando para migrar la base de datos-> php artisan migrate
        //comando para ejecutar los seeder's-> php artisan db:seed
        //comando para reconstruir la base de datos y ejecutar los seeder's -> php artisan migrate:fresh --seed

        $this->call([DocumentoSeeder::class]);
        // $this->call([CaracteristicaSeeder::class]);
        // $this->call([MarcaSeeder::class]);
        // $this->call(RoleAndPermissionSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
