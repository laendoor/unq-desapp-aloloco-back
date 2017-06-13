<?php

namespace Tests\Api;

use App\Model\Offer;
use Carbon\Carbon;
use App\Model\ProductCategory;
use App\Model\Product\StockedProduct;
use App\Repository\StockedProductRepository;

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
        entity(ProductCategory::class)->create(['name'  => 'Gaseosas']);
        entity(ProductCategory::class)->create(['name'  => 'Snacks']);

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

    /**
     * @test
     *
     * @return void
     */
    public function it_get_all_offers()
    {
        // Arrange
        $soda   = entity(ProductCategory::class)->create(['name'  => 'Gaseosas']);
        $snacks = entity(ProductCategory::class)->create(['name'  => 'Snacks']);

        $offer1 = entity(Offer::class)->create(['category' => $soda]);
        $offer2 = entity(Offer::class)->create(['category' => $snacks]);

        // Act
        $offers = $this->api->get('products/categories/offers');

        // Assert
        $this->assertEquals(2, $offers->count());
        $this->assertContains($offer1, $offers);
        $this->assertContains($offer2, $offers);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_store_a_category_offer()
    {
        // Arrange
        $soda = entity(ProductCategory::class)->create(['name'  => 'Gaseosas']);
        $category_id = $soda->getId();
        $percentage  = 25;
        $valid_from  = Carbon::now()->subDay(10);
        $valid_to    = Carbon::now()->addDay(10);

        // Act
        $this->api
            ->with(compact('category_id', 'percentage', 'valid_from', 'valid_to'))
            ->post("products/categories/offers/");

        // Assert
        $this->assertDatabaseHas('offers', [
            'category_id' => $soda->getId(),
            'percentage'  => $percentage,
            'valid_from'  => $valid_from,
            'valid_to'    => $valid_to,
        ]);
    }
}
