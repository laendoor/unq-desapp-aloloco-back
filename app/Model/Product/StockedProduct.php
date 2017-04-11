<?php
namespace App\Model;

use App\Model\Product\Product;

class StockedProduct extends Product
{

    /**
     * @var int
     */
    private $stock;

    public function __construct(string $name, string $brand,
                                Price $price, int $stock, string $image = '')
    {
        parent::__construct($name, $brand, $price, $image);

        $this->stock = $stock;
    }

}