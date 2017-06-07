<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Threshold\ThresholdState;
use App\Model\Threshold\ThresholdStateEnabled;
use App\Model\Threshold\ThresholdStateDisabled;

/**
 * Class Threshold
 * @package App\Model
 *
 * @ORM\Entity
 */
abstract class Threshold
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

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
        $this->state = new ThresholdStateEnabled($this->limit);
    }

    public function disable(): void {
        $this->state = new ThresholdStateDisabled($this->limit);
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