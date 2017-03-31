<?php

namespace App\Model\Product;


abstract class State
{
    public function isWished(): bool { return false; }
}