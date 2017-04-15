<?php

namespace Tests\Unit;

use App\Model\BoxTime;
use Carbon\Carbon;
use Tests\TestCase;

class BoxTimeTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_has_a_datetime_and_a_time(): void {
        // Arrange
        $now = Carbon::now();
        $box_time = new BoxTime($now, 20);

        // Assert
        $this->assertEquals(20, $box_time->getTime());
        $this->assertTrue($box_time->getDateTime()->eq($now));
    }
}
