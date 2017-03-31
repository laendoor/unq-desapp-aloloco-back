<?php

namespace App\Model;

use App\Model\Product\State\OnCart;
use App\Model\Product\State\Wished;
use App\Model\Product\State\Purchased;
use App\Model\Product\State\ForDelivery;

class Product
{
    protected $code;
    protected $state;

    public function __construct() {
        $this->state = new Wished;
    }

    /*
     * Actions
     */

    public function addedToCart() {
        $this->state = new OnCart;
    }

    public function removedFromCart() {
        $this->state = new Wished;
    }

    public function purchased() {
        $this->state = new Purchased;
    }

    public function addedForDelivery() {
        $this->state = new ForDelivery;
    }

    /*
     * State dependent methods
     */

    public function isWished(): bool {
        return $this->state->isWished();
    }

    public function isOnCart(): bool {
        return $this->state->isOnCart();
    }

    public function isPurchased(): bool {
        return $this->state->isPurchased();
    }

    public function isForDelivery(): bool {
        return $this->state->isForDelivery();
    }

    /*
     * Getters
     */

    public function getCode(): string {
        return $this->code;
    }

    /*
     * Comparing
     */

    public function equals(Product $another): bool {
        return $this->getCode() == $another->getCode();
    }
}