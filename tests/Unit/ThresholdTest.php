<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Tests\Builders\ThresholdBuilder;
use App\Model\Price;
use App\Model\Product\ProductCategory;

/**
 * Class ThresholdTest
 * @package Tests\Unit
 */
class ThresholdTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function general_threshold_is_initialized_with_price_limit(): void {
        // Arrange
        $price = Mockery::mock(Price::class);
        $threshold = ThresholdBuilder::new()->withLimit($price)->buildGeneral();

        // Assert
        $this->assertEquals($price, $threshold->getLimit());
    }

    /**
     * @test
     *
     * @return void
     */
    public function category_threshold_is_initialized_with_price_limit_and_category(): void {
        // Arrange
        $price = Mockery::mock(Price::class);
        $category = Mockery::mock(ProductCategory::class);
        $threshold = ThresholdBuilder::new()->withLimit($price)->withCategory($category)->buildCategory();

        // Assert
        $this->assertEquals($price, $threshold->getLimit());
        $this->assertEquals($category, $threshold->getCategory());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_disabled_by_default(): void {
        // Arrange
        $threshold = ThresholdBuilder::anyGeneralBuiltWithMocks();

        // Assert
        $this->assertTrue($threshold->isDisabled());
        $this->assertFalse($threshold->isEnabled());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_be_enabled(): void {
        // Arrange
        $threshold = ThresholdBuilder::anyGeneralBuiltWithMocks();

        // Act
        $threshold->enable();

        // Assert
        $this->assertTrue($threshold->isEnabled());
        $this->assertFalse($threshold->isDisabled());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_switch_between_enabled_and_disabled(): void {
        // Arrange
        $threshold = ThresholdBuilder::anyGeneralBuiltWithMocks();

        // Act
        $threshold->enable();
        $threshold->disable();

        // Assert
        $this->assertTrue($threshold->isDisabled());
        $this->assertFalse($threshold->isEnabled());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_never_exceeded_when_is_disabled(): void {
        // Arrange
        $limit = Mockery::mock(Price::class);
        $value = Mockery::mock(Price::class);
        $threshold = ThresholdBuilder::new()->withLimit($limit)->buildGeneral();

        // Act
        $threshold->disable();

        // Assert
        $this->assertFalse($threshold->isExceededWith($value));
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_exceeded_on_enabled_when_limit_is_less_than_value(): void {
        // Arrange
        $limit = Mockery::mock(Price::class);
        $value = Mockery::mock(Price::class);
        $limit->shouldReceive('isLessThan')->with($value)->andReturn(true);
        $threshold = ThresholdBuilder::new()->withLimit($limit)->buildGeneral();

        // Act
        $threshold->enable();

        // Assert
        $this->assertTrue($threshold->isExceededWith($value));
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_is_not_exceeded_on_enabled_when_limit_is_greater_or_equals_than_value(): void {
        // Arrange
        $limit = Mockery::mock(Price::class);
        $value = Mockery::mock(Price::class);
        $limit->shouldReceive('isLessThan')->with($value)->andReturn(false);
        $threshold = ThresholdBuilder::new()->withLimit($limit)->buildGeneral();

        // Act
        $threshold->enable();

        // Assert
        $this->assertFalse($threshold->isExceededWith($value));
    }
}
