<?php
namespace App\Model;

/**
 * Class Client
 * @package App\Model
 */
class Client
{
    /**
     * @var Market
     */
    private $market;

    public function __construct(Market $market)
    {
        $this->market = $market;
    }

    public function getMarket()
    {
        return $this->market;
    }
}