<?php

namespace Tests\Builders;

use App\Model\ShoppingList;
use Illuminate\Support\Collection;

class ShoppingListBuilder
{
    protected $products;

    public function __construct() {
        $this->products = new Collection;
    }

    public static function new(): self {
        return new self;
    }

    public static function anyBuilt(): ShoppingList {
        return self::new()->build();
    }

    public function build(): ShoppingList {
        $list = new ShoppingList;
        $list->addProducts($this->products);

        return $list;
    }

}