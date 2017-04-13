<?php
namespace App\Model\Threshold;

use App\Model\Price;

/**
 * Class ThresholdStateDisabled
 * @package App\Model
 */
class ThresholdStateDisabled extends ThresholdState
{
    public function isEnabled(): bool {
        return false;
    }

    function isDisabled(): bool {
        return true;
    }

    public function isExceededWith(Price $value): bool {
        return false;
    }
}