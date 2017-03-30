<?php

namespace App\Model;


use Illuminate\Support\Collection;

class ShoppingList
{
    protected $wishProducts;

    /**
     * ShoppingList constructor.
     */
    public function __construct()
    {
        $this->wishProducts = new Collection;
    }

    /**
     * @return Collection
     */
    public function getWishProducts(): Collection {
        return $this->wishProducts;
    }

    /**
     * @return Collection
     */
    public function getMarketProducts(): Collection {
        return new Collection;
    }

    /**
     * @param $product
     */
    public function addProduct(Product $product): void {
        $this->wishProducts->push($product);
    }

    /**
     * @param $product
     */
    public function removeProduct(Product $product): void {
        $this->wishProducts = $this->wishProducts->reject(function (Product $item) use ($product) {
            return $item->equals($product);
        });
    }
}