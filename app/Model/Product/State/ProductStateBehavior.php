<?php
namespace App\Model\Product\State;

use App\Model\Product\ProductState;

/**
 * Trait ProductStateBehavior
 * @package Model\Product\State
 */
trait ProductStateBehavior
{
    /**
     * @var ProductState
     */
    protected $state;

    /*
     * Action has happened
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
}