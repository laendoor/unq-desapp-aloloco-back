<?php

namespace App\Model\Product\State;

use App\Model\Product\State;

class ForDelivery extends State
{
    public function isForDelivery(): bool {
        return true;
    }
}