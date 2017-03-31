<?php

namespace App\Model;

use App\Model\Product\State\OnCart;
use App\Model\Product\State\Wished;
use App\Model\Product\State\Purchased;

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

    public function purchased() {
        $this->state = new Purchased;
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