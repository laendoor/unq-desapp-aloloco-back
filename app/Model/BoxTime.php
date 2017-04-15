<?php

namespace App\Model;

use Carbon\Carbon;

/**
 * Class BoxTime
 * @package App\Model
 */
class BoxTime
{
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
