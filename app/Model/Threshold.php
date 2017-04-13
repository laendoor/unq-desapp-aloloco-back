<?php
namespace App\Model;

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

    public function __construct(Price $limit) {
        $this->limit = $limit;
    }

    public function getLimit(): Price {
        return $this->limit;
    }
}