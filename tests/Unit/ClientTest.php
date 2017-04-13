<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Tests\Builders\UserBuilder;
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

        // Act
        $jon->addList($list);

        // Assert
        $this->assertContains($list, $jon->getSetOfLists());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_remove_a_shopping_list(): void {
        // Arrange
        $listToKeep   = Mockery::mock(ShoppingList::class)->shouldReceive('equals')->andReturn(false)->getMock();
        $listToRemove = Mockery::mock(ShoppingList::class)->shouldReceive('equals')->andReturn(true)->getMock();
        $jon = UserBuilder::newWithMocks()
            ->withShoppingList($listToKeep)
            ->withShoppingList($listToRemove)
            ->buildClient();

        // Act
        $jon->removeList($listToRemove);

        // Assert
        $this->assertContains($listToKeep, $jon->getSetOfLists());
        $this->assertNotContains($listToRemove, $jon->getSetOfLists());
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
        $list->shouldReceive('addProduct')->with($sugar)->once();
        $list->shouldReceive('getProducts')->andReturn(new ArrayCollection([$sugar]))->once();
        $jon = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        $jon->addProduct($sugar, $list);

        // Assert
        $this->assertContains($sugar, $jon->getSetOfLists()->first()->getProducts());
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
        $this->assertContains($coffee, $jon->getSetOfLists()->first()->getProducts());
        $this->assertNotContains($sugar, $jon->getSetOfLists()->first()->getProducts());
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
}
