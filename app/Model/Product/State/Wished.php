<?php

namespace App\Model\Product\State;

use App\Model\Product\ProductState;

class Wished extends ProductState
{
    public function isWished(): bool {
        return true;
    }
}