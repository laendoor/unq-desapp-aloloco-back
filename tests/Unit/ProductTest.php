<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Product;

class ProductTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_are_equals_when_have_same_name_and_brand()
    {
        $coffee = new Product('Coffee', 'Cabrales');
        $anotherCoffee = new Product('Coffee', 'Cabrales');

        $this->assertTrue($coffee->equals($anotherCoffee));
    }
}