<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Model\Product;
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
        $l1 = ShoppingListBuilder::new()->withName('New List')->build();
        $l2 = ShoppingListBuilder::new()->withName('New List')->build();
        $l3 = ShoppingListBuilder::new()->withName('Old List')->build();

        $this->assertTrue($l1->equals($l2));
        $this->assertFalse($l2->equals($l3));
    }

    /**
     * @test
     * New Shopping List has no products
     *
     * @return void
     */
    public function it_has_no_products_when_is_created()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $this->assertTrue($list->getProducts()->isEmpty());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_add_a_product_to_list()
    {
        $list   = ShoppingListBuilder::anyBuilt();
        $coffee = Mockery::mock(Product::class);

        $list->addProduct($coffee);

        $this->assertEquals(1, $list->getProducts()->count());
        $this->assertEquals($coffee, $list->getProducts()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_remove_a_product_from_list()
    {
        $list = ShoppingListBuilder::anyBuilt();
        $sugar  = Mockery::mock(Product::class)->shouldReceive('equals')->andReturn(false)->getMock();
        $coffee = Mockery::mock(Product::class)->shouldReceive('equals')->andReturn(true)->getMock();

        $list->addProduct($sugar);
        $list->addProduct($coffee);
        $list->removeProduct($coffee);

        $this->assertEquals(1, $list->getProducts()->count());
        $this->assertEquals($sugar, $list->getProducts()->first());
    }

    // TODO: depends of State
    //+ addToCart(p:Product)
    //+ removeFromCart(p:Product)
    //+ markAsWish()
    //+ markAsMarket()
    //+ markAsDelivery()
    //+ markAsPurchase()
}
