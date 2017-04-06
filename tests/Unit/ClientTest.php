<?php
namespace Tests\Unit;

use Mockery;
use App\Model\Market;
use Tests\Builders\ClientBuilder;
use Tests\TestCase;

/**
 * Class ClientTest
 * @package Tests\Unit
 */
class ClientTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_start_with_a_market()
    {
        $market = Mockery::mock(Market::class);
        $jon = ClientBuilder::new()->withMarket($market)->build();

        $this->assertEquals($market, $jon->getMarket());
    }
}
