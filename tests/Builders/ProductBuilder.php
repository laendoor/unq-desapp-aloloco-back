<?php

namespace Tests\Builders;

use App\Model\Product;

class ProductBuilder
{
    protected $code;
    protected $name;
    protected $brand;
    protected $price;

    public function __construct() {
        $this->name  = 'A Name';
        $this->brand = 'A Brand';
    }

    public static function new(): self {
        return new self;
    }

    public static function anyBuilt(): Product {
        return self::new()->build();
    }

    public function build(): Product {
        $product = new Product($this->name, $this->brand);

        return $product;
    }
}