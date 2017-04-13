<?php

namespace App\Model\Product\State;

use App\Model\Product\ProductState;

class OnCart extends ProductState
{
    public function isOnCart(): bool {
        return true;
    }
}