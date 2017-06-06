<?php

namespace Tests\Api;

use App\Model\Product\StockedProduct;
use App\Repository\StockedProductRepository;
use Illuminate\Http\UploadedFile;
use App\Model\Product;

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
        entity(Product::class)->create([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'image' => 'lays.jpg',
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
