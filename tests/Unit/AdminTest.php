<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Tests\Builders\UserBuilder;
use App\Model\Market;

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
}
