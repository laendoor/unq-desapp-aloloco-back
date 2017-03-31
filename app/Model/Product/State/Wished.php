<?php

namespace App\Model\Product\State;

use App\Model\Product\State;

class Wished extends State
{
    public function isWished(): bool { return true; }
}