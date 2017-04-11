<?php
namespace App\Model\Product;

use App\Model\Price;

class Product
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $brand;
    /**
     * @var Price
     */
    private $price;
    /**
     * @var string
     */
    private $image;

    public function __construct(string $name, string $brand,
                                Price $price, string $image = '') {
        $this->name  = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->image = $image;
    }

    /*
     * Getters
     */

    public function getName(): string {
        return $this->name;
    }

    public function getBrand(): string {
        return $this->brand;
    }

    /*
     * Comparing
     */

    public function equals(Product $another): bool {
        return $this->getName()  == $another->getName()
            && $this->getBrand() == $another->getBrand();
    }
}