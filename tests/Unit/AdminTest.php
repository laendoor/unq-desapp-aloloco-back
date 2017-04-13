<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Tests\Builders\UserBuilder;
use App\Model\Market;
use App\Model\Product\StockedProduct;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AdminTest
 * @package Tests\Unit
 */
class AdminTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_is_initialized_with_a_market_and_an_email(): void {
        // Arrange
        $email  = 'admin@mail.com';
        $market = Mockery::mock(Market::class);
        $ned = UserBuilder::new()->withMarket($market)->withEmail($email)->buildAdmin();

        // Assert
        $this->assertEquals($email, $ned->getEmail());
        $this->assertEquals($market, $ned->getMarket());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_update_market_stock(): void {
        // Arrange
        $coffee = Mockery::mock(StockedProduct::class);
        $sugar  = Mockery::mock(StockedProduct::class);
        $milk   = Mockery::mock(StockedProduct::class);
        $stock  = new ArrayCollection([$coffee, $sugar, $milk]);
        $market = Mockery::mock(Market::class);
        $market->shouldReceive('getStock')->once()->andReturn($stock);
        $market->shouldReceive('cleanStock')->once();
        $market->shouldReceive('addProduct')->atLeast()->once();
        $ned = UserBuilder::newWithMocks()->withMarket($market)->buildAdmin();

        // Act
        $ned->updateStock($stock);

        // Assert
        $this->assertEquals($stock, $ned->getStock());
    }
}
