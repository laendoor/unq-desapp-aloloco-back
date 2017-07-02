<?php
namespace Tests\Unit;

use App\Model\Offer;
use App\Model\ProductCategory;
use Carbon\Carbon;
use Tests\TestCase;

class OfferTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_stores_and_retrieves()
    {
        // Arrange
        $valid_from  = Carbon::now()->subDay(10)->toDateTimeString();
        $valid_to    = Carbon::now()->addDay(10)->toDateTimeString();
        $category = new ProductCategory();
        $offer = new Offer($category, 10, $valid_from, $valid_to);

        // Assert
        $this->assertEquals($category, $offer->getCategory());
        $this->assertEquals(10, $offer->getPercentage());
        $this->assertEquals($valid_from, $offer->getValidFrom());
        $this->assertEquals($valid_to, $offer->getValidTo());
    }
}