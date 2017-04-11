<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Model\WishedProduct;
use Tests\Builders\ShoppingListBuilder;

class ShoppingTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_are_equals_when_have_same_name()
    {
        $list1 = ShoppingListBuilder::new()->withName('New List')->build();
        $list2 = ShoppingListBuilder::new()->withName('New List')->build();
        $list3 = ShoppingListBuilder::new()->withName('Old List')->build();

        $this->assertTrue($list1->equals($list2));
        $this->assertFalse($list2->equals($list3));
    }

    /**
     * @test
     * New Shopping List has no products
     *
     * @return void
     */
    public function it_has_no_wish_products_when_is_created()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $this->assertTrue($list->getWishProducts()->isEmpty());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_add_a_wish_product_to_list()
    {
        $list   = ShoppingListBuilder::anyBuilt();
        $coffee = Mockery::mock(WishedProduct::class);

        $list->addProduct($coffee);

        $this->assertEquals(1, $list->getWishProducts()->count());
        $this->assertEquals($coffee, $list->getWishProducts()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_remove_a_product_from_list()
    {
        $list = ShoppingListBuilder::anyBuilt();
        $sugar  = Mockery::mock(WishedProduct::class)->shouldReceive('equals')->andReturn(false)->getMock();
        $coffee = Mockery::mock(WishedProduct::class)->shouldReceive('equals')->andReturn(true)->getMock();

        $list->addProduct($sugar);
        $list->addProduct($coffee);
        $list->removeProduct($coffee);

        $this->assertEquals(1, $list->getWishProducts()->count());
        $this->assertEquals($sugar, $list->getWishProducts()->first());
    }

    // TODO: depends of State
    //+ addToCart(p:Product)
    //+ removeFromCart(p:Product)
    //+ markAsWish()
    //+ markAsMarket()
    //+ markAsDelivery()
    //+ markAsPurchase()
}
