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
            ->build();
        $anotherCoffee = ProductBuilder::new()
            ->withName('Coffee')
            ->withBrand('Cabrales')
            ->withImage('ftp')
            ->build();

        $this->assertTrue($coffee->equals($anotherCoffee));
    }
}