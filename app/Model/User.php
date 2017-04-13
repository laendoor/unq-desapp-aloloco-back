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
     * @var string
     */
    private $email;

    /**
     * Client constructor.
     * @param Market $market
     * @param string $email
     */
    public function __construct(Market $market, string $email) {
        $this->email  = $email;
        $this->market = $market;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market {
        return $this->market;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }
}