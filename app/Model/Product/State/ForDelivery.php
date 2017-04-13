<?php

namespace App\Model\Product\State;

use App\Model\Product\ProductState;

class ForDelivery extends ProductState
{
    public function isForDelivery(): bool {
        return true;
    }
}