<?php

namespace App\Model;


use App\Model\Product\State\Wished;

class Product
{
    protected $state;

    public function __construct()
    {
        $this->state = new Wished;
    }

    public function isWished(): bool {
        return $this->state->isWished();
    }

    public function getCode(): string { return ''; }

    public function equals(Product $another): bool {
        return $this->getCode() == $another->getCode();
    }
}