<?php

namespace Tests\Builders;

use Mockery;
use App\Model\Product;
use App\Model\WishedProduct;
use App\Model\Price;
use App\Model\Product\StockedProduct;

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

    public static function anyBuiltProduct(): Product
    {
        return self::new()->buildProduct();
    }

    public function buildProduct(): Product
    {
        return new Product($this->name, $this->brand, $this->price, $this->stock, $this->image);
    }

    public function buildWished(): WishedProduct
    {
        return new WishedProduct($this->buildProduct(), $this->quantity);
    }

    public function withName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function withBrand(string $brand): self {
        $this->brand = $brand;

        return $this;
    }

    public function withImage(string $image): self {
        $this->image = $image;

        return $this;
    }

    public function withQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function withPrice(float $value, int $digits): self
    {
        $this->price = new Price($value, $digits);

        return $this;
    }

    public function withStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

}