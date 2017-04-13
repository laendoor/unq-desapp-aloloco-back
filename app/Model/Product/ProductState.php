<?php

namespace App\Model\Product;


abstract class ProductState
{
    public function isWished(): bool {
        return false;
    }

    public function isOnCart(): bool {
        return false;
    }

    public function isPurchased(): bool {
        return false;
    }

    public function isForDelivery(): bool {
        return false;
    }
}