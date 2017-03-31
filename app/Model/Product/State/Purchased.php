<?php

namespace App\Model\Product\State;

use App\Model\Product\State;

class Purchased extends State
{
    public function isPurchased(): bool {
        return true;
    }
}