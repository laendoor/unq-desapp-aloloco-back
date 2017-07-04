<?php

use App\Model\Offer;
use App\Model\Product;
use App\Model\ProductCategory;
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
        $fries       = $this->createCategory('Papas Fritas');
        $oil         = $this->createCategory('Aceite');
        $washingSoap = $this->createCategory('Jabón en Polvo');
        $bean        = $this->createCategory('Porotos');
        $beer        = $this->createCategory('Cerveza');
        $cakeTop     = $this->createCategory('Tapa de Tarta');
        $sugar       = $this->createCategory('Azúcar');
        $deodorant   = $this->createCategory('Desodorante');
        $cotton      = $this->createCategory('Algodón');
        $soap        = $this->createCategory('Jabón');
        $milk        = $this->createCategory('Leche');
        $wine        = $this->createCategory('Vino Tinto');

        $this->createProduct($fries,       'Lays',       10);
        $this->createProduct($oil,         'Natura',     10);
        $this->createProduct($washingSoap, 'Zorro',       2);
        $this->createProduct($bean,        'Arcor',       1);
        $this->createProduct($beer,        'Quilmes',    50);
        $this->createProduct($cakeTop,     'La Salteña', 12);
        $this->createProduct($sugar,       'Chango',     14);
        $this->createProduct($deodorant,   'Rexona',      3);
        $this->createProduct($cotton,      'Estrella',   14);
        $this->createProduct($soap,        'Suave',       1);
        $this->createProduct($milk,        'Sancor',     50);
        $this->createProduct($wine,        'Uvita',      55);

        $this->createOffer($fries, 10);
        $this->createOffer($bean,   5);
        $this->createOffer($beer,  25);
        $this->createOffer($sugar, 30);
        $this->createOffer($milk,  10);
        $this->createOffer($wine,  50);
    }

    protected function createProduct($category, $brand, $stock)
    {
        return entity(Product::class)->create([
            'name'  => $category->getName(),
            'brand' => $brand,
            'stock' => $stock,
        ]);
    }

    protected function createCategory($name)
    {
        return entity(ProductCategory::class)->create([
            'name' => $name
        ]);
    }

    protected function createOffer($category, $percentage)
    {
        return entity(Offer::class)->create([
            'category'   => $category,
            'percentage' => $percentage
        ]);
    }
}
