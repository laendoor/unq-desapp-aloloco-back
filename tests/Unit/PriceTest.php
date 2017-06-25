<?php

namespace Tests\Unit;

use App\Model\Price;
use Tests\TestCase;

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
    public function a_price_is_initialized_with_a_float_value(): void
    {
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
    public function a_price_has_two_decimal_digits_by_default(): void
    {
        // Arrange
        $value = 10.1234;
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
    public function a_price_can_be_initialized_with_custom_digits_format(): void
    {
        // Arrange
        $digits = 4;
        $value = 10.23456;
        $expected_value = 10.2346;
        $price = new Price($value, $digits);

        // Assert
        $this->assertSame($expected_value, $price->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function two_prices_can_be_added(): void
    {
        // Arrange
        $ten = new Price(10);
        $five = new Price(5.3);

        // Act
        $sum = $ten->add($five);

        // Assert
        $this->assertSame(15.30, $sum->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function two_prices_can_be_subtracted(): void
    {
        // Arrange
        $ten = new Price(10.5);
        $five = new Price(5.3);

        // Act
        $sub = $ten->sub($five);

        // Assert
        $this->assertSame(5.20, $sub->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_price_can_be_multiplied_by_scalar_number(): void
    {
        // Arrange
        $scalar = 7;
        $price = new Price(8.7);

        // Act
        $mul = $price->multiply($scalar);

        // Assert
        $this->assertSame(60.90, $mul->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_price_can_be_divided_by_scalar_number(): void
    {
        // Arrange
        $scalar = 4;
        $price = new Price(12.5);

        // Act
        $div = $price->divide($scalar);

        // Assert
        $this->assertSame(3.13, $div->getValue());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_price_could_be_lesser_than_another(): void
    {
        // Arrange
        $ten = new Price(10);
        $five = new Price(5.3);

        // Assert
        $this->assertTrue($five->isLesserThan($ten));
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_price_could_be_greater_than_another(): void
    {
        // Arrange
        $ten = new Price(10);
        $five = new Price(5.3);

        // Assert
        $this->assertTrue($ten->isGreaterThan($five));
    }

    /**
     * @test
     *
     * @return void
     */
    public function two_prices_could_be_equals(): void
    {
        // Arrange
        $price1 = new Price(5);
        $price2 = new Price(5.0);

        // Assert
        $this->assertTrue($price1->isEqualsThan($price2));
    }

}
