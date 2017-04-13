<?php
namespace App\Model;

/**
 * Class User
 * @package App\Model
 */
abstract class User
{
    /**
     * @var Market
     */
    protected $market;

    /**
     * Client constructor.
     * @param Market $market
     */
    public function __construct(Market $market) {
        $this->market = $market;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market {
        return $this->market;
    }
}