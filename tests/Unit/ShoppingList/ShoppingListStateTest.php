<?php

namespace Tests\Unit\Product;

use Tests\Builders\ShoppingListBuilder;
use Tests\TestCase;

class ShoppingListStateTest extends TestCase
{
    /*
     * State flow
     *
     * + Expected Flow 1: Buy Products
     * [new]--> WishList --[markAsMarket]--> MarketList --[markAsPurchased]--> PurchasedList
     *
     * + Expected Flow 2: Send Products to Home
     * [new]--> WishList --[markAsMarket]--> MarketList --[markAsDelivery]--> DeliveryList
     *
     * + Expected Flow 3: Leave market and back to home without buy products
     * [new]--> WishList --[markAsMarket]--> MarketList --[markAsWish]--> WishList
     */

    /**
     * @test
     *
     * @return void
     */
    public function it_is_wish_list_on_new()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $this->assertTrue($list->isWishList());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_market_list_when_is_brought_to_market()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $list->markAsMarket();

        $this->assertTrue($list->isMarketList());
    }

    /**
     * @test
     *
     * Flow 1: Buy Products
     * [new]--> WishList --[markAsMarket]--> MarketList --[markAsPurchased]--> PurchasedList
     *
     * @return void
     */
    public function it_is_purchased_list_when_is_bought()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $list->markAsMarket();
        $list->markAsPurchased();

        $this->assertTrue($list->isPurchasedList());
    }

    /**
     * @test
     *
     * Flow 2: Send Products to Home
     * [new]--> WishList --[markAsMarket]--> MarketList --[markAsDelivery]--> DeliveryList
     *
     * @return void
     */
    public function it_is_to_delivery_list_when_is_requested_to_send_home()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $list->markAsMarket();
        $list->markAsDelivery();

        $this->assertTrue($list->isDeliveryList());
    }

    /**
     * @test
     *
     * Flow 3: Leave market and back to home without buy products
     * [new]--> WishList --[markAsMarket]--> MarketList --[markAsWish]--> WishList
     *
     * @return void
     */
    public function it_is_wish_list_when_market_is_leaving_without_buy_products()
    {
        $list = ShoppingListBuilder::anyBuilt();

        $list->markAsMarket();
        $list->markAsWish();

        $this->assertTrue($list->isWishList());
    }
}