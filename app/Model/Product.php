<?php

namespace App\Model;


class Product
{
    public function getCode(): string { return ''; }

    public function equals(Product $another): bool {
        return $this->getCode() == $another->getCode();
    }
}