<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Model\Market;
use App\Model\ShoppingList;
use Tests\Builders\ClientBuilder;

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

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_new_shopping_list()
    {
        $jon = ClientBuilder::anyBuiltWithMocks();
        $list = Mockery::mock(ShoppingList::class);

        $jon->addList($list);

        $this->assertEquals($list, $jon->getLists()->first());
    }
}
