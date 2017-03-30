<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Product;
use App\Model\ShoppingList;

class ShoppingTest extends TestCase
{
    /**
     * @test
     * New Shopping List has no products
     *
     * @return void
     */
    public function it_has_no_products_when_is_created()
    {
        $list = new ShoppingList;

        $this->assertTrue($list->getWishProducts()->isEmpty());
        $this->assertTrue($list->getMarketProducts()->isEmpty());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_add_a_product_to_wish_list()
    {
        $list   = new ShoppingList;
        $coffee = $this->createMock(Product::class);

        $list->addProduct($coffee);

        $this->assertEquals(1, $list->getWishProducts()->count());
        $this->assertEquals($coffee, $list->getWishProducts()->first());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_remove_a_product_from_wish_list()
    {
        $list = new ShoppingList;
        $sugar  = $this->createMock(Product::class);
        $coffee = $this->createMock(Product::class);
        $coffee->method('equals')->willReturn(true);

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
