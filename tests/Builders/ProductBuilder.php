<?php

namespace Tests\Builders;

use App\Model\Product\Price;
use App\Model\Product\Product;
use App\Model\Product\WishedProduct;
use Mockery;

class ProductBuilder
{
    protected $name;
    protected $brand;
    protected $price;
    protected $image;
    protected $stock;
    protected $quantity;

    public function __construct()
    {
        $this->name = 'A Name';
        $this->brand = 'A Brand';
        $this->price = Mockery::mock(Price::class);
        $this->image = 'url';
        $this->stock = 0;
        $this->quantity = 0;
    }

    public static function new(): self
    {
        return new self;
    }

    public static function anyBuiltWished(): WishedProduct
    {
        return self::new()->buildWished();
    }

    public function build(): Product
    {
        return new Product(
            $this->name,
            $this->brand,
            $this->price,
            $this->quantity,
            $this->image
        );
    }

    public function buildWished(): WishedProduct
    {
        return new WishedProduct(
            $this->name,
            $this->brand,
            $this->price,
            $this->quantity,
            $this->image
        );
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function withImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function withQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

}