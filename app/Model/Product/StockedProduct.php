<?php
namespace App\Model\Product;

use App\Model\Price;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class StockedProduct
 * @package App\Model\Product
 *
 * @ORM\Entity
 */
class StockedProduct extends Product
{

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    public function __construct(string $name, string $brand,
                                Price $price, int $stock, string $image = '')
    {
        parent::__construct($name, $brand, $price, $image);

        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }

}