<?php
namespace App\Model\Threshold;

use App\Model\Price;

/**
 * Class ThresholdState
 * @package App\Model\Threshold
 */
abstract class ThresholdState
{
    /**
     * @var Price
     */
    protected $limit;

    public function __construct(Price $limit) {
        $this->limit = $limit;
    }

    abstract public function isEnabled(): bool;

    abstract public function isDisabled(): bool;

    abstract public function isExceededWith(Price $value): bool;
}