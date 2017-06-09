<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Custom
        entity(Product::class)->create([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'stock' => 10,
        ]);

        entity(Product::class)->create([
            'name'  => 'Aceite',
            'brand' => 'Natura',
            'stock' => 10,
        ]);

        entity(Product::class)->create([
            'name'  => 'Jabón en Polvo',
            'brand' => 'Zorro',
            'stock' => 2,
        ]);

        entity(Product::class)->create([
            'name'  => 'Porotos',
            'brand' => 'Arcor',
            'stock' => 1,
        ]);

        entity(Product::class)->create([
            'name'  => 'Cerveza',
            'brand' => 'Quilmes',
            'stock' => 50,
        ]);

        entity(Product::class)->create([
            'name'  => 'Tapa de Tarta',
            'brand' => 'La Salteña',
            'stock' => 12,
        ]);

        entity(Product::class)->create([
            'name'  => 'Azúcar',
            'brand' => 'Chango',
            'stock' => 14,
        ]);

        entity(Product::class)->create([
            'name'  => 'Desodorante',
            'brand' => 'Rexona',
            'stock' => 3,
        ]);

        entity(Product::class)->create([
            'name'  => 'Algodón',
            'brand' => 'Estrella',
            'stock' => 14,
        ]);

        entity(Product::class)->create([
            'name'  => 'Jabón',
            'brand' => 'Suave',
            'stock' => 1,
        ]);

        entity(Product::class)->create([
            'name'  => 'Leche',
            'brand' => 'Sancor',
            'stock' => 50,
        ]);

        entity(Product::class)->create([
            'name'  => 'Vino Tinto',
            'brand' => 'Uvita',
            'stock' => 55,
        ]);

    }
}
