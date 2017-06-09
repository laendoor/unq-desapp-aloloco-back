<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Admin
 * @package App\Model
 *
 * @ORM\Entity
 */
class Admin
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
    private $market;
    /**
     * @var string
     */
    private $email;

    /**
     * Admin constructor.
     * @param Market $market
     * @param string $email
     */
    public function __construct(Market $market, string $email) {
        $this->email  = $email;
        $this->market = $market;
    }

    public function updateStock(ArrayCollection $stock): void {
        $this->market->cleanStock();
        $stock->forAll(function ($key, $product) {
            $this->market->addProduct($product);
        });
    }

    public function getStock(): ArrayCollection {
        return $this->market->getStock();
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market {
        return $this->market;
    }
}