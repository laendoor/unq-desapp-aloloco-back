<?php
namespace App\Model\Product;

use App\Model\Product\State\Wished;
use App\Model\Product\State\ProductStateBehavior;

class WishedProduct extends Product
{
    use ProductStateBehavior;

    /**
     * @var int
     */
    private $quantity;

    public function __construct(string $name, string $brand,
                                Price $price, int $quantity, string $image = '')
    {
        parent::__construct($name, $brand, $price, $image);

        $this->state    = new Wished;
        $this->quantity = $quantity;
    }

}