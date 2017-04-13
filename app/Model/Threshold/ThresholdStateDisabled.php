<?php
namespace App\Model\Threshold;

/**
 * Class ThresholdStateDisabled
 * @package App\Model
 */
class ThresholdStateDisabled extends ThresholdState
{
    function isDisabled(): bool {
        return true;
    }
}