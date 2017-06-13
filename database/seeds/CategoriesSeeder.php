<?php

use App\Model\ProductCategory;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        entity(ProductCategory::class)->create(['name'  => 'Cervezas']);
        entity(ProductCategory::class)->create(['name'  => 'Gaseosas']);
        entity(ProductCategory::class)->create(['name'  => 'Vinos']);
        entity(ProductCategory::class)->create(['name'  => 'Snacks']);
        entity(ProductCategory::class)->create(['name'  => 'Lácteos']);
        entity(ProductCategory::class)->create(['name'  => 'Cereales']);
        entity(ProductCategory::class)->create(['name'  => 'Congelados']);
        entity(ProductCategory::class)->create(['name'  => 'Pastas']);
        entity(ProductCategory::class)->create(['name'  => 'Higiene Personal']);
        entity(ProductCategory::class)->create(['name'  => 'Limpieza']);
        entity(ProductCategory::class)->create(['name'  => 'Infusiones']);
    }
}
