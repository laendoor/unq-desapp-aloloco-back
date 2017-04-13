<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Price;

/**
 * Class PriceTest
 * @package Tests\Unit
 */
class PriceTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function a_price_is_initialized_with_a_float_value(): void {
        // Arrange
        $value = 10.0;
        $price = new Price($value);

        // Assert
        $this->assertSame($value, $price->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_price_has_two_decimal_digits_by_default(): void {
        // Arrange
        $value  = 10.1234;
        $expected_value = 10.12;
        $price = new Price($value);

        // Assert
        $this->assertSame($expected_value, $price->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_price_can_be_initialized_with_custom_digits_format(): void {
        // Arrange
        $digits = 4;
        $value  = 10.23456;
        $expected_value = 10.2346;
        $price = new Price($value, $digits);

        // Assert
        $this->assertSame($expected_value, $price->getValue());
    }
}
