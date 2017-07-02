<?php
namespace Tests\Integrations;

use Carbon\Carbon;
use App\Model\Offer;
use App\Model\ProductCategory;
use App\Repository\OfferRepository;

class OfferTest extends IntegrationsTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->repo = resolve(OfferRepository::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_stores_and_retrieves()
    {
        // Arrange
        $category    = entity(ProductCategory::class)->create(['name' => 'Vino']);
        $valid_from  = Carbon::now()->subDay(10);
        $valid_to    = Carbon::now()->addDay(10);
        $offer = entity(Offer::class)->create([
            'category'   => $category,
            'percentage' => 10,
            'valid_from' => $valid_from,
            'valid_to' => $valid_to
        ]);

        // Assert
        $this->assertEquals(1, $offer->getId());
        $this->assertEquals($category, $offer->getCategory());
        $this->assertEquals(10, $offer->getPercentage());
        $this->assertEquals($valid_from, $offer->getValidFrom());
        $this->assertEquals($valid_to, $offer->getValidTo());
        $this->assertEquals(Offer::class . "(1)", $offer->__toString());
    }
}