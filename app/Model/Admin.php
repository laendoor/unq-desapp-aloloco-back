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

    public function updateStock(ArrayCollection $stock): void {
        $this->market->cleanStock();
        $stock->forAll(function ($key, $product) {
            $this->market->addProduct($product);
        });
    }

    public function getStock(): ArrayCollection {
        return $this->market->getStock();
    }
}