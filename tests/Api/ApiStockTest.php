<?php

namespace Api;

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
        entity(Product::class)->create($productData);

        // Act
        $response = $this->get(apiRoute('stock.get'));

        // Assert
        $response->assertJsonFragment($productData);
    }
}
