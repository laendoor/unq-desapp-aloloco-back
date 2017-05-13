<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Tests\Builders\UserBuilder;
use App\Model\Box;
use App\Model\Market;
use App\Model\ShoppingList;
use App\Model\Product\WishedProduct;
use App\Model\Threshold\GeneralThreshold;
use App\Model\Threshold\CategoryThreshold;
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
    public function it_is_initialized_with_a_market_and_an_email(): void {
        // Arrange
        $email  = 'client@mail.com';
        $market = Mockery::mock(Market::class);
        $jon = UserBuilder::new()->withMarket($market)->withEmail($email)->buildClient();

        // Assert
        $this->assertEquals($email, $jon->getEmail());
        $this->assertEquals($market, $jon->getMarket());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_new_shopping_list(): void {
        // Arrange
        $jon = UserBuilder::anyClientBuiltWithMocks();
        $list = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('setClient')->andReturnNull();

        // Act
        $jon->addShoppingList($list);

        // Assert
        $this->assertContains($list, $jon->getShoppingLists());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_remove_a_shopping_list(): void {
        // Arrange
        $listToKeep   = Mockery::mock(ShoppingList::class)
            ->shouldReceive([
                'equals'    => true,
                'setClient' => null
            ])->getMock();
        $listToRemove = Mockery::mock(ShoppingList::class)
            ->shouldReceive([
                'equals'    => true,
                'setClient' => null
            ])->getMock();
        $jon = UserBuilder::newWithMocks()
            ->withShoppingList($listToKeep)
            ->withShoppingList($listToRemove)
            ->buildClient();

        // Act
        $jon->removeList($listToRemove);

        // Assert
        $this->assertContains($listToKeep, $jon->getShoppingLists());
        $this->assertNotContains($listToRemove, $jon->getShoppingLists());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_product_to_a_shopping_list(): void {
        // Arrange
        $sugar = Mockery::mock(WishedProduct::class);
        $list  = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('addProduct')->with($sugar)->once();
        $list->shouldReceive('getProducts')->andReturn(new ArrayCollection([$sugar]))->once();
        $jon = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        $jon->addProduct($sugar, $list);

        // Assert
        $this->assertContains($sugar, $jon->getShoppingLists()->first()->getProducts());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_remove_a_product_from_a_shopping_list(): void {
        // Arrange
        $sugar  = Mockery::mock(WishedProduct::class);
        $coffee = Mockery::mock(WishedProduct::class);
        $list = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('addProduct')->with($sugar)->once();
        $list->shouldReceive('addProduct')->with($coffee)->once();
        $list->shouldReceive('removeProduct')->with($sugar)->once();
        $list->shouldReceive('getProducts')->andReturn(new ArrayCollection([$coffee]))->twice();
        $jon = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        $jon->addProduct($sugar, $list);
        $jon->addProduct($coffee, $list);
        $jon->removeProduct($sugar, $list);

        // Assert
        $this->assertContains($coffee, $jon->getShoppingLists()->first()->getProducts());
        $this->assertNotContains($sugar, $jon->getShoppingLists()->first()->getProducts());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_add_a_threshold(): void {
        // Arrange
        $threshold = Mockery::mock(GeneralThreshold::class);
        $jon = UserBuilder::anyClientBuiltWithMocks();

        // Act
        $jon->addThreshold($threshold);

        // Assert
        $this->assertContains($threshold, $jon->getThresholds());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_remove_a_threshold(): void {
        // Arrange
        $thresholdToKeep   = Mockery::mock(GeneralThreshold::class);
        $thresholdToRemove = Mockery::mock(CategoryThreshold::class);
        $jon = UserBuilder::newWithMocks()
            ->withThreshold($thresholdToKeep)
            ->withThreshold($thresholdToRemove)
            ->buildClient();

        // Act
        $jon->removeThreshold($thresholdToRemove);

        // Assert
        $this->assertContains($thresholdToKeep, $jon->getThresholds());
        $this->assertNotContains($thresholdToRemove, $jon->getThresholds());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_go_to_the_market_with_a_wished_shopping_list(): void {
        // Arrange
        $list = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('markAsMarket')->once();
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('isMarketList')->once()->andReturn(true);
        $jon = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        $jon->goToTheMarket($list);

        // Assert
        $this->assertTrue($jon->getShoppingLists()->first()->isMarketList());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_check_product_from_list_when_is_at_market(): void {
        // Arrange
        $coffee = Mockery::mock(WishedProduct::class);
        $coffee->shouldReceive('isOnCart')->andReturn(true)->once();
        $list = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('markAsMarket')->once();
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('addProduct')->with($coffee)->once();
        $list->shouldReceive('addToCart')->with($coffee)->once();
        $list->shouldReceive('getWishProducts')->andReturn(new ArrayCollection([$coffee]))->once();
        $jon = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        $jon->addProduct($coffee, $list);
        $jon->goToTheMarket($list);
        $jon->checkProduct($coffee, $list);

        // Assert
        $this->assertTrue($jon->getShoppingLists()->first()->getWishProducts()->first()->isOnCart());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_uncheck_product_from_list_when_is_at_market(): void {
        // Arrange
        $coffee = Mockery::mock(WishedProduct::class);
        $coffee->shouldReceive('isWished')->andReturn(true)->once();
        $list = Mockery::mock(ShoppingList::class);
        $list->shouldReceive('markAsMarket')->once();
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('addProduct')->with($coffee)->once();
        $list->shouldReceive('addToCart')->with($coffee)->once();
        $list->shouldReceive('removeFromCart')->with($coffee)->once();
        $list->shouldReceive('getWishProducts')->andReturn(new ArrayCollection([$coffee]))->once();
        $jon = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        $jon->addProduct($coffee, $list);
        $jon->goToTheMarket($list);
        $jon->checkProduct($coffee, $list);
        $jon->uncheckProduct($coffee, $list);

        // Assert
        $this->assertTrue($jon->getShoppingLists()->first()->getWishProducts()->first()->isWished());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_request_for_a_box_when_is_ready_and_get_estimated_time(): void {
        // Arrange
        $list   = Mockery::mock(ShoppingList::class);
        $market = Mockery::mock(Market::class);
        $market->shouldReceive('estimatedWaitingTime')->with($list)->andReturn(5);
        $jon = UserBuilder::newWithMocks()->withMarket($market)->buildClient();

        // Act
        $time = $jon->requestBox($list);

        // Assert
        $this->assertEquals(5, $time); // minutes
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_go_to_the_box_when_is_called(): void {
        // Arrange
        $box    = Mockery::mock(Box::class);
        $market = Mockery::mock(Market::class);
        $list   = Mockery::mock(ShoppingList::class);
        $jon    = UserBuilder::newWithMocks()->withMarket($market)->buildClient();
        $market->shouldReceive('goingToBox')->once()->withArgs([$box, $jon, $list]);

        // Act
        $jon->goToTheBox($box, $list);

        // Assert
        // mmm... nothing to assert?
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_buy_a_list(): void {
        // Arrange
        $box    = Mockery::mock(Box::class);
        $market = Mockery::mock(Market::class);
        $list   = Mockery::mock(ShoppingList::class);
        $jon    = UserBuilder::newWithMocks()->withMarket($market)->buildClient();
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('markAsPurchased')->once()->withNoArgs();
        $market->shouldReceive('purchaseMade')->once()->withArgs([$box, $jon, $list]);

        // Act
        $jon->buyList($box, $list);

        // Assert
        // mmm... nothing to assert?
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_request_list_for_delivery(): void {
        // Arrange
        $box    = Mockery::mock(Box::class);
        $market = Mockery::mock(Market::class);
        $list   = Mockery::mock(ShoppingList::class);
        $jon    = UserBuilder::newWithMocks()->withMarket($market)->buildClient();
        $list->shouldReceive('setClient')->andReturnNull();
        $list->shouldReceive('markAsDelivery')->once()->withNoArgs();
        $market->shouldReceive('deliveryRequest')->once()->withArgs([$box, $jon, $list]);

        // Act
        $jon->requestForDelivery($box, $list);

        // Assert
        // mmm... nothing to assert?
    }
}
