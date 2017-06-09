<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Builders\ProductBuilder;

class WishedProductTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function creation()
    {
        $coffee = ProductBuilder::new()
            ->withName('Coffee')
            ->withBrand('Cabrales')
            ->withImage('http')
            ->withQuantity(2)
            ->buildWished();
        $coffee->setId(1);

        $this->assertEquals(1, $coffee->getId());
        $this->assertEquals(2, $coffee->getQuantity());
        $this->assertEquals('Coffee',   $coffee->getName());
        $this->assertEquals('Cabrales', $coffee->getBrand());
        $this->assertEquals('http',     $coffee->getImage());
    }
}