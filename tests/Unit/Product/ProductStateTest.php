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
     * [new]--> Wished --[addToCart]--> OnCart --[purchase]--> Purchased
     *
     * + Expected Flow 2: Send Product to Home
     * [new]--> Wished --[addToCart]--> OnCart --[addToDelivery]--> ToDelivery
     *
     * + Expected Flow 3: Regret to put in the cart
     * [new]--> Wished --[addToCart]--> OnCart --[removeFromCart]--> Wished
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
}