<?php

namespace Tests\Unit\Product;

use Tests\Builders\ProductBuilder;
use Tests\TestCase;

class ProductStateTest extends TestCase
{
    /*
     * State flow
     *
     * + Expected Flow 1: Buy Product
     * [new]--> Wished --[addedToCart]--> OnCart --[purchased]--> Purchased
     *
     * + Expected Flow 2: Send Product to Home
     * [new]--> Wished --[addedToCart]--> OnCart --[addedToDelivery]--> ToDelivery
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
        $coffee = ProductBuilder::new()->build();

        $this->assertTrue($coffee->isWished());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_on_cart_when_is_added()
    {
        $coffee = ProductBuilder::new()->build();

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
        $coffee = ProductBuilder::new()->build();

        $coffee->addedToCart();
        $coffee->purchased();

        $this->assertTrue($coffee->isPurchased());
    }
}