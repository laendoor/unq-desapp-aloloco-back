<?php

namespace Api;

use App\Model\Product\Price;
use App\Model\Product\StockedProduct;
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
    public function it_store_stock_from_csv_file()
    {
        // Act
        $response = $this->put(apiRoute('stock.store'));

        // Assert
        $response->assertJson([
            'error' => '400',
            'description' => 'TODO'
        ]);
    }
}
