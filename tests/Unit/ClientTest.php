<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Model\Market;
use App\Model\Product;
use App\Model\ShoppingList;
use App\Model\Threshold\GeneralThreshold;
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
    public function it_is_initialized_with_a_market_and_a_general_threshold(): void {
        $market    = Mockery::mock(Market::class);
        $threshold = Mockery::mock(GeneralThreshold::class);
        $jon = ClientBuilder::new()
            ->withMarket($market)
            ->withGeneralThreshold($threshold)
            ->build();

        $this->assertEquals($market, $jon->getMarket());
        $this->assertEquals($threshold, $jon->getGeneralThreshold());
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
        $jon = ClientBuilder::newWithMocks()
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
        $jon = ClientBuilder::newWithMocks()->withShoppingList($list)->build();

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
        $jon = ClientBuilder::newWithMocks()->withShoppingList($list)->build();

        // Act
        $jon->addProduct($sugar, $list);
        $jon->addProduct($coffee, $list);
        $jon->removeProduct($sugar, $list);

        // Assert
        $this->assertEquals(1, $jon->getSetOfLists()->first()->getProducts()->count());
        $this->assertEquals($coffee, $jon->getSetOfLists()->first()->getProducts()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_general_threshold(): void {
        // Arrange
        $threshold = Mockery::mock(GeneralThreshold::class);
        $jon = ClientBuilder::anyBuiltWithMocks();

        // Act
        $jon->setGeneralThreshold($threshold);

        // Assert
        $this->assertEquals($threshold, $jon->getGeneralThreshold());
    }
}
