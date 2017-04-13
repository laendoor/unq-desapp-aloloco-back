<?php
namespace Tests\Builders;

use App\Model\Price;
use App\Model\Threshold\GeneralThreshold;
use Mockery;

/**
 * Class ThresholdBuilder
 * @package Tests\Unit
 */
class ThresholdBuilder
{
    protected $price;

    public function __construct() {
    }

    public static function new(): self {
        return new self;
    }

    public static function newWithMocks(): self {
        return self::new()
            ->withPrice(Mockery::mock(Price::class));
    }

    public static function anyGeneralBuiltWithMocks(): GeneralThreshold {
        return self::newWithMocks()->buildGeneral();
    }

    public function buildGeneral(): GeneralThreshold {
        return new GeneralThreshold($this->price);
    }

    /*
     * Withs
     */

    public function withPrice(Price $price): self {
        $this->price = $price;
        return $this;
    }
}