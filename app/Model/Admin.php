<?php
namespace App\Model;


/**
 * Class Admin
 * @package App\Model
 */
class Admin extends User
{

    /**
     * Admin constructor.
     * @param Market $market
     * @param string $email
     */
    public function __construct(Market $market, string $email) {
        parent::__construct($market, $email);
    }
}