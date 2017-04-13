<?php
namespace App\Model\Threshold;

use App\Model\Price;

/**
 * Class ThresholdStateEnabled
 * @package App\Model
 */
class ThresholdStateEnabled extends ThresholdState
{
    public function isEnabled(): bool {
        return true;
    }

    public function isDisabled(): bool {
        return false;
    }

    /**
     * @SuppressWarnings("PMD.StaticAccess")
     * @param Price $value
     * @return bool
     */
    public function isExceededWith(Price $value): bool {
        return $this->limit->isLessThan($value);
    }
}