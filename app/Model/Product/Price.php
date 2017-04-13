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

    public function isLesserThan(Price $another): bool {
        return $this->getValue() < $another->getValue();
    }

    public function isGreaterThan(Price $another): bool {
        return $this->getValue() > $another->getValue();
    }

    public function isEqualsThan(Price $another): bool {
        return $this->getValue() === $another->getValue();
    }

    public function add(Price $another): self {
        $sum = $this->getValue() + $another->getValue();

        return new self($sum, $this->digits);
    }

    public function sub(Price $another): self {
        $sub = $this->getValue() - $another->getValue();

        return new self($sub, $this->digits);
    }

    public function multiply(int $scalar): self {
        $mul = $this->getValue() * $scalar;

        return new self($mul, $this->digits);
    }

    public function divide(int $scalar): self {
        $div = $this->getValue() / $scalar;

        return new self($div, $this->digits);
    }

    /*
     * Getters && Setters
     */

    public function getValue(): float {
        return float_formatted($this->value, $this->digits);
    }
}