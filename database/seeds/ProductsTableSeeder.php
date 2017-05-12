<?php

use App\Model\Product\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generic Fakers
        entity(Product::class, 2)->create();

        // Custom
        entity(Product::class, 'french-fries', 2)->create();
        entity(Product::class, 'soda', 2)->create();
        entity(Product::class, 'milk', 2)->create();
    }
}
