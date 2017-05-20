<?php

namespace Tests\Unit;

use App\Model\Price;
use Tests\Builders\ProductBuilder;
use Tests\TestCase;

class StockedProductTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_is_created_as_product_but_with_stock_value()
    {
        $coffee = ProductBuilder::anyBuiltStocked();
        $coffee->setStock(10);

        $this->assertEquals(10, $coffee->getStock());
    }
}