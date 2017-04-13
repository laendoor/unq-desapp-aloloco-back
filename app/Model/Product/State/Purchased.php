<?php

namespace App\Model\Product\State;

use App\Model\Product\ProductState;

class Purchased extends ProductState
{
    public function isPurchased(): bool {
        return true;
    }
}