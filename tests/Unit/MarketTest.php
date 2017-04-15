<?php

namespace Tests\Unit;

use App\Model\Box;
use App\Model\BoxTime;
use App\Model\Market;
use Carbon\Carbon;
use Tests\TestCase;

class MarketTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_has_an_estimated_waiting_time(): void
    {
        // Arrange
        $market = new Market();
        // Fixme: no puedo pasarle el mock al addBox. $a_disabled_box = Mockery::mock(Box::class)->shouldReceive('isEnabled')->andReturn(false)->getMock();
        $a_disabled_box = new Box(1, false);
        $an_enabled_box = new Box(1, true);
        $another_enabled_box = new Box(2, true);

        // Act
        $market->addBox($a_disabled_box);
        $market->addBox($an_enabled_box);
        $market->addBox($another_enabled_box);

        $a_disabled_box->addBoxTime(new BoxTime(Carbon::now(), 20));
        $an_enabled_box->addBoxTime(new BoxTime(Carbon::now(), 15));
        $another_enabled_box->addBoxTime(new BoxTime(Carbon::now(), 20));
        $another_enabled_box->addBoxTime(new BoxTime(Carbon::now(), 30));

        // Assert
        $this->assertEquals(20, $market->estimatedWaitingTime());
    }
}
