<?php

namespace Tests\Builders;

use App\Model\Product;

class ProductBuilder
{
    protected $product;

    public function __construct() {
        $this->product = new Product;
    }

    public static function new(): self {
        return new self;
    }

    public function build(): Product {
        return $this->product;
    }

//    public function withName($name): self {
//        $this->product->setName($name);
//
//        return $this;
//    }
}