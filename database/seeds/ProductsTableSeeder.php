<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Model\Product\StockedProduct;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Custom
        entity(StockedProduct::class)->create([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'stock' => 10,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Aceite',
            'brand' => 'Natura',
            'stock' => 10,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Jabón en Polvo',
            'brand' => 'Zorro',
            'stock' => 2,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Porotos',
            'brand' => 'Arcor',
            'stock' => 1,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Cerveza',
            'brand' => 'Quilmes',
            'stock' => 50,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Tapa de Tarta',
            'brand' => 'La Salteña',
            'stock' => 12,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Azúcar',
            'brand' => 'Chango',
            'stock' => 14,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Desodorante',
            'brand' => 'Rexona',
            'stock' => 3,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Algodón',
            'brand' => 'Estrella',
            'stock' => 14,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Jabón',
            'brand' => 'Suave',
            'stock' => 1,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Leche',
            'brand' => 'Sancor',
            'stock' => 50,
        ]);

        entity(StockedProduct::class)->create([
            'name'  => 'Vino Tinto',
            'brand' => 'Uvita',
            'stock' => 55,
        ]);


    }
}
