<?php

namespace App\Model\Threshold;

/**
 * Class ThresholdStateEnabled
 * @package App\Model
 */
class ThresholdStateEnabled extends ThresholdState
{
    function isEnabled(): bool {
        return true;
    }
}