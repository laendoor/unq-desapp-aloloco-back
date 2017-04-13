<?php
namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use Tests\Builders\ThresholdBuilder;
use App\Model\Price;
use App\Model\Product\ProductCategory;
use App\Model\Threshold\GeneralThreshold;
use App\Model\Threshold\CategoryThreshold;

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
        $threshold = new GeneralThreshold($price);

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
        $threshold = new CategoryThreshold($price, $category);

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
}
