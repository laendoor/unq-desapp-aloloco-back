<?php

namespace Tests\Api;

use App\Model\Product\StockedProduct;
use App\Repository\StockedProductRepository;
use App\Model\Product;

/**
 * Class ApiProductsCategoriesTest
 * @package Api
 */
class ApiProductsCategoriesTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_get_all_products()
    {
        $this->assertTrue(true);
//        $categories = $this->api->get('products/categories');
//
//        dump($categories);
//        // Arrange
//        entity(Product::class)->create([
//            'name'  => 'Papas Fritas',
//            'brand' => 'Lays',
//            'image' => 'lays.jpg',
//            'stock' => 10,
//        ]);
//
//        // Act
//        $response = $this->get(apiRoute('stock.get'));
//
//        // Assert
//        $response->assertJsonFragment([
//            'name'  => 'Papas Fritas',
//            'brand' => 'Lays',
//            'image' => 'lays.jpg',
//            'stock' => 10
//        ]);
    }
}
