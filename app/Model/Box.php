<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Box
 * @package App\Model
 *
 * @ORM\Entity
 */
class Box
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var ArrayCollection<BoxTime>
     */
    protected $boxTimes;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var int
     */
    protected $number;

    /**
     * Box constructor.
     *
     * @param int  $number
     * @param bool $enabled
     */
    public function __construct(int $number, bool $enabled)
    {
        $this->boxTimes = new ArrayCollection;
        $this->enabled = $enabled;
        $this->number = $number;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return void
     */
    public function disable(): void
    {
        $this->enabled = false;
    }

    /**
     * @return void
     */
    public function enable(): void
    {
        $this->enabled = true;
    }

    /**
     * @param BoxTime $boxTime
     *
     * @return void
     */
    public function addBoxTime(BoxTime $boxTime): void
    {
        $this->boxTimes->add($boxTime);
    }

    /**
     * @return int
     */
    public function estimatedWaitingTime(): int
    {
        $boxTimes = $this->boxTimes->map(function (BoxTime $boxTime) {
            return $boxTime->getTime();
        })->toArray();

        return array_sum($boxTimes) / count($boxTimes);
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }
}
