<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Model
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 */
abstract class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var Market
     */
    protected $market;

    /**
     * @ORM\Column(type="string")
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

    /*
     * Getters
     */

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
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