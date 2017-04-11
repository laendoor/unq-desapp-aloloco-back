<?php

namespace Tests\Unit\Product;

use Tests\TestCase;
use Tests\Builders\ProductBuilder;

class ProductStateTest extends TestCase
{
    /*
     * State flow
     *
     * + Expected Flow 1: Buy Product
     * [new]--> Wished --[addedToCart]--> OnCart --[purchased]--> Purchased
     *
     * + Expected Flow 2: Send Product to Home
     * [new]--> Wished --[addedToCart]--> OnCart --[addedForDelivery]--> ForDelivery
     *
     * + Expected Flow 3: Regret to put in the cart
     * [new]--> Wished --[addedToCart]--> OnCart --[removedFromCart]--> Wished
     */

    /**
     * @test
     *
     * @return void
     */
    public function it_is_wished_on_new()
    {
        $coffee = ProductBuilder::anyBuiltWished();

        $this->assertTrue($coffee->isWished());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_on_cart_when_is_added()
    {
        $coffee = ProductBuilder::anyBuiltWished();

        $coffee->addedToCart();

        $this->assertTrue($coffee->isOnCart());
    }

    /**
     * @test
     *
     * Flow 1: Buy Product
     * [new]--> Wished --[addedToCart]--> OnCart --[purchased]--> Purchased
     *
     * @return void
     */
    public function it_is_purchased_when_is_bought()
    {
        $coffee = ProductBuilder::anyBuiltWished();

        $coffee->addedToCart();
        $coffee->purchased();

        $this->assertTrue($coffee->isPurchased());
    }

    /**
     * @test
     *
     * Flow 2: Send Product to Home
     * [new]--> Wished --[addedToCart]--> OnCart --[addedForDelivery]--> ForDelivery
     *
     * @return void
     */
    public function it_is_to_delivery_when_is_sent_to_home()
    {
        $coffee = ProductBuilder::anyBuiltWished();

        $coffee->addedToCart();
        $coffee->addedForDelivery();

        $this->assertTrue($coffee->isForDelivery());
    }

    /**
     * @test
     *
     * Flow 3: Regret to put in the cart
     * [new]--> Wished --[addedToCart]--> OnCart --[removedFromCart]--> Wished
     *
     * @return void
     */
    public function it_is_wished_when_is_removed_from_cart()
    {
        $coffee = ProductBuilder::anyBuiltWished();

        $coffee->addedToCart();
        $coffee->removedFromCart();

        $this->assertTrue($coffee->isWished());
    }
}