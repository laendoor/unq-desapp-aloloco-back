<?php
namespace App\Model\Threshold;

/**
 * Class ThresholdState
 * @package App\Model\Threshold
 */
abstract class ThresholdState
{
    function isEnabled(): bool {
        return false;
    }

    function isDisabled(): bool {
        return false;
    }
}