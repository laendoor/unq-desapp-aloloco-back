<?php
namespace App\Model;

use App\Model\Threshold\ThresholdState;
use App\Model\Threshold\ThresholdStateEnabled;
use App\Model\Threshold\ThresholdStateDisabled;

/**
 * Class Threshold
 * @package App\Model
 */
abstract class Threshold
{
    /**
     * @var Price
     */
    private $limit;
    /**
     * @var ThresholdState
     */
    private $state;

    public function __construct(Price $limit) {
        $this->limit = $limit;
        $this->disable();
    }

    public function enable(): void {
        $this->state = new ThresholdStateEnabled;
    }

    public function disable(): void {
        $this->state = new ThresholdStateDisabled;
    }

    public function getLimit(): Price {
        return $this->limit;
    }

    public function isEnabled(): bool {
        return $this->state->isEnabled();
    }

    public function isDisabled(): bool {
        return $this->state->isDisabled();
    }

    public function isExceededWith(Price $value): bool {
        return $this->state->isExceededWith($value);
    }
}