<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::insert([
            [
                'nombre' => 'Cera para Cabello',
                'descripcion' => 'Cera de alta fijación para peinados modernos.',
                'precio' => 25000,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Shampoo Anticaspa',
                'descripcion' => 'Shampoo especializado para eliminar la caspa.',
                'precio' => 18000,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Peine Profesional',
                'descripcion' => 'Peine de alta calidad para barberos.',
                'precio' => 12000,
                'imagen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
