<?php

namespace Tests\Unit;

use Mockery;
use Carbon\Carbon;
use Tests\TestCase;
use App\Model\Box;
use App\Model\Market;
use App\Model\BoxTime;
use App\Model\ShoppingList;

class MarketTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_has_an_estimated_waiting_time(): void {
        // Arrange
        $market = new Market;
        $a_list = Mockery::mock(ShoppingList::class);
        $a_disabled_box = Mockery::mock(Box::class);
        $an_enabled_box = Mockery::mock(Box::class);
        $another_enabled_box = Mockery::mock(Box::class);

        $a_disabled_box->shouldReceive('isEnabled')->once()->andReturn(false);
        $an_enabled_box->shouldReceive('isEnabled')->once()->andReturn(true);
        $another_enabled_box->shouldReceive('isEnabled')->once()->andReturn(true);

        $a_disabled_box->shouldReceive('estimatedWaitingTime')->never();
        $an_enabled_box->shouldReceive('estimatedWaitingTime')->once()->andReturn(15);
        $another_enabled_box->shouldReceive('estimatedWaitingTime')->once()->andReturn(25);

        // Act
        $market->addBox($a_disabled_box);
        $market->addBox($an_enabled_box);
        $market->addBox($another_enabled_box);
        $estimated_time = $market->estimatedWaitingTime($a_list);

        // Assert
        $this->assertEquals(20, $estimated_time);
    }
}
