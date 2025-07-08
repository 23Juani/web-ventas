<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaracteristicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('caracteristicas')->insert(
            [
                // Marcas
                ['nombre' => 'Pil', 'descripcion' => 'Marca boliviana de alimentos y bebidas'],
                ['nombre' => 'Kris', 'descripcion' => 'Marca boliviana de galletas y snacks'],
                ['nombre' => 'Soyección', 'descripcion' => 'Marca boliviana de productos de soya'],
                ['nombre' => 'El Ceibo', 'descripcion' => 'Marca boliviana de chocolate y cacao'],
                ['nombre' => 'Andean Valley', 'descripcion' => 'Marca boliviana de quinua y granos andinos'],

                // Características generales
                ['nombre' => 'Orgánico', 'descripcion' => 'Producto cultivado sin químicos artificiales'],
                ['nombre' => 'Gluten Free', 'descripcion' => 'Producto sin gluten'],
                ['nombre' => 'Vegano', 'descripcion' => 'Producto sin ingredientes de origen animal'],
                ['nombre' => 'Sin azúcar añadida', 'descripcion' => 'Producto sin azúcares adicionales'],
                ['nombre' => 'Alto en proteína', 'descripcion' => 'Producto con alto contenido proteico'],

                // Origen
                ['nombre' => 'Hecho en Bolivia', 'descripcion' => 'Producto fabricado en Bolivia'],
                ['nombre' => 'Producto local', 'descripcion' => 'Fabricado en la región'],
                ['nombre' => 'Importado', 'descripcion' => 'Producto importado'],

                // Categorías
                ['nombre' => 'Alimento', 'descripcion' => 'Producto comestible'],
                ['nombre' => 'Bebida', 'descripcion' => 'Producto líquido para consumo'],
                ['nombre' => 'Snack', 'descripcion' => 'Producto para picar entre comidas'],
                ['nombre' => 'Cosmético', 'descripcion' => 'Producto para cuidado personal'],

                // Especiales
                ['nombre' => 'Edición limitada', 'descripcion' => 'Producto de producción limitada'],
                ['nombre' => 'Artesanal', 'descripcion' => 'Producto hecho a mano o en pequeña escala'],
                ['nombre' => 'Tradicional', 'descripcion' => 'Producto con receta o método tradicional']
            ]
        );
    }
}
