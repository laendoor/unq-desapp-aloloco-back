<?php

namespace Api;

use App\Model\Product\Price;
use App\Model\Product\StockedProduct;
use App\Repository\StockedProductRepository;
use Illuminate\Http\UploadedFile;
use Tests\Api\ApiTestCase;
use App\Model\Product\Product;

/**
 * Class ApiStockTest
 * @package Api
 */
class ApiStockTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_get_all_products()
    {
        // Arrange
        $productData = [
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'image' => 'lays.jpg'
        ];
        $product = entity(Product::class)->create($productData);
        entity(StockedProduct::class)->create([
            'name' => $product->getName(),
            'brand' => $product->getBrand(),
            'image' => $product->getImage(),
            'stock' => 10,
        ]);

        // Act
        $response = $this->get(apiRoute('stock.get'));

        // Assert
        $response->assertJsonFragment([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'image' => 'lays.jpg',
            'stock' => 10
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_store_stock_from_csv_file(): void {
        // Arrange
        $path = base_path('doc/Productos.csv');
        $name = 'Productos.csv';
        $file = new UploadedFile($path, $name, filesize($path), 'text/csv', null, true);

        // Act
        $response = $this->put(apiRoute('stock.store'), [
            'file' => $file
        ]);

        // Assert
        $response->assertJson([
            'store' => true,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Bizcochos',
            'brand' => 'Don Satur',
        ]);
    }
}
