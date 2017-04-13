<?php

namespace App\Model;

/**
 * Class Price
 * @package App\Model
 */
class Price
{
    /**
     * @var float
     */
    protected $value;
    /**
     * @var int
     */
    protected $digits;

    public function __construct(float $value, int $digits = 2) {
        $this->value  = floatval($value);
        $this->digits = $digits;
    }

    public function isLessThan(Price $another): bool {
        return $this->getValue() < $another->getValue();
    }

    public function getValue(): float {
        return float_formatted($this->value, $this->digits);
    }
}