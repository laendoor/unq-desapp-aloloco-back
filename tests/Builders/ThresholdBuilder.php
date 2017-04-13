<?php
namespace Tests\Builders;

use Mockery;
use App\Model\Price;
use App\Model\Product\ProductCategory;
use App\Model\Threshold\GeneralThreshold;
use App\Model\Threshold\CategoryThreshold;

/**
 * Class ThresholdBuilder
 * @package Tests\Unit
 */
class ThresholdBuilder
{
    protected $price;
    protected $category;

    public function __construct() {
    }

    public static function new(): self {
        return new self;
    }

    public static function newWithMocks(): self {
        return self::new()
            ->withPrice(Mockery::mock(Price::class))
            ->withCategory(Mockery::mock(ProductCategory::class));
    }

    public static function anyGeneralBuiltWithMocks(): GeneralThreshold {
        return self::newWithMocks()->buildGeneral();
    }

    public function buildGeneral(): GeneralThreshold {
        return new GeneralThreshold($this->price);
    }

    public function buildCategory(): CategoryThreshold {
        return new CategoryThreshold($this->price, $this->category);
    }

    /*
     * Withs
     */

    public function withPrice(Price $price): self {
        $this->price = $price;
        return $this;
    }

    public function withCategory(ProductCategory $category): self {
        $this->category = $category;
        return $this;
    }
}