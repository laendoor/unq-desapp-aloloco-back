<?php

namespace Tests\Unit;

use App\Model\Price;
use Tests\Builders\ProductBuilder;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_are_equals_when_have_same_name_and_brand()
    {
        $coffee = ProductBuilder::new()
            ->withName('Coffee')
            ->withBrand('Cabrales')
            ->withImage('http')
            ->buildProduct();
        $anotherCoffee = ProductBuilder::new()
            ->withName('Coffee')
            ->withBrand('Cabrales')
            ->withImage('ftp')
            ->buildProduct();

        $this->assertTrue($coffee->equals($anotherCoffee));
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_created_as_product_but_with_stock_value()
    {
        $coffee = ProductBuilder::anyBuiltProduct();
        $coffee->setStock(10);

        $this->assertEquals(10, $coffee->getStock());
    }
}