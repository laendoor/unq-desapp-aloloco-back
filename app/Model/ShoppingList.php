<?php

namespace App\Model;


use Illuminate\Support\Collection;

class ShoppingList
{
    protected $products;

    /**
     * ShoppingList constructor.
     */
    public function __construct()
    {
        $this->products = new Collection;
    }

    /**
     * @return Collection
     */
    public function getProducts(): Collection {
        return $this->products;
    }

    /**
     * @param $product
     */
    public function addProduct(Product $product): void {
        $this->products->push($product);
    }

    /**
     * @param $product
     */
    public function removeProduct(Product $product): void {
        $this->products = $this->products->reject(function (Product $item) use ($product) {
            return $item->equals($product);
        });
    }
}