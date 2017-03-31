<?php

namespace App\Model\Product\State;

use App\Model\Product\State;

class OnCart extends State
{
    public function isOnCart(): bool {
        return true;
    }
}