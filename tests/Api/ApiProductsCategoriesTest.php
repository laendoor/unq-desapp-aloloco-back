<?php

namespace Tests\Api;

use App\Model\Product\StockedProduct;
use App\Model\ProductCategory;
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
        // Arrange
        $soda   = entity(ProductCategory::class)->create(['name'  => 'Gaseosas']);
        $snacks = entity(ProductCategory::class)->create(['name'  => 'Snacks']);

        // Act
        $categories = $this->api->get('products/categories');
        $categories = $categories->map(function ($category) {
            return $category->getName();
        });

        // Assert
        $this->assertEquals(2, $categories->count());
        $this->assertContains('Gaseosas', $categories);
        $this->assertContains('Snacks', $categories);
    }
}
