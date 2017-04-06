<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Model\Market;
use App\Model\Product;
use App\Model\ShoppingList;
use Tests\Builders\ClientBuilder;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function it_start_with_a_market(): void {
        $market = Mockery::mock(Market::class);
        $jon = ClientBuilder::new()->withMarket($market)->build();

        $this->assertEquals($market, $jon->getMarket());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_new_shopping_list(): void {
        $jon = ClientBuilder::anyBuiltWithMocks();
        $list = Mockery::mock(ShoppingList::class);

        $jon->addList($list);

        $this->assertEquals($list, $jon->getSetOfLists()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_remove_a_shopping_list(): void {
        $listToKeep   = Mockery::mock(ShoppingList::class)->shouldReceive('equals')->andReturn(false)->getMock();
        $listToRemove = Mockery::mock(ShoppingList::class)->shouldReceive('equals')->andReturn(true)->getMock();
        $jon = ClientBuilder::newWithMarketMocked()
            ->withShoppingList($listToKeep)
            ->withShoppingList($listToRemove)
            ->build();

        $jon->removeList($listToRemove);

        $this->assertEquals(1, $jon->getSetOfLists()->count());
        $this->assertEquals($listToKeep, $jon->getSetOfLists()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_product_to_a_shopping_list(): void {
        // Arrange
        $sugar = Mockery::mock(Product::class);
        $list  = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('addProduct')->with($sugar)->once();
        $list->shouldReceive('getProducts')->andReturn(new ArrayCollection([$sugar]))->once();
        $jon = ClientBuilder::newWithMarketMocked()->withShoppingList($list)->build();

        // Act
        $jon->addProduct($sugar, $list);

        // Assert
        $this->assertEquals($sugar, $jon->getSetOfLists()->first()->getProducts()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_remove_a_product_from_a_shopping_list(): void {
        // Arrange
        $sugar  = Mockery::mock(Product::class);
        $coffee = Mockery::mock(Product::class);
        $list = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('addProduct')->with($sugar)->once();
        $list->shouldReceive('addProduct')->with($coffee)->once();
        $list->shouldReceive('removeProduct')->with($sugar)->once();
        $list->shouldReceive('getProducts')->andReturn(new ArrayCollection([$coffee]))->twice();
        $jon = ClientBuilder::newWithMarketMocked()->withShoppingList($list)->build();

        // Act
        $jon->addProduct($sugar, $list);
        $jon->addProduct($coffee, $list);
        $jon->removeProduct($sugar, $list);

        // Assert
        $this->assertEquals(1, $jon->getSetOfLists()->first()->getProducts()->count());
        $this->assertEquals($coffee, $jon->getSetOfLists()->first()->getProducts()->first());
    }
}
