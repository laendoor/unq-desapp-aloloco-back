<?php
namespace App\Model;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BoxTime
 * @package App\Model
 *
 * @ORM\Entity
 */
class BoxTime
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var Carbon
     */
    protected $dateTime;

    /**
     * @var int
     */
    protected $time;

    public function __construct(Carbon $dateTime, int $time)
    {
        $this->dateTime = $dateTime;
        $this->time = $time;
    }

    /**
     * @return Carbon
     */
    public function getDateTime(): Carbon
    {
        return $this->dateTime;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }
}
