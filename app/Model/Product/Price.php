<?php

namespace App\Model;

/**
 * Class Price
 * @package App\Model
 */
class Price
{

    public function isLessThan(Price $another): bool {
        return $this->getValue() < $another->getValue();
    }

    public function getValue(): float {
    }
}