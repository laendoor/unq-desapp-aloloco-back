<?php

namespace Tests\Builders;

use App\Model\ShoppingList;
use Illuminate\Support\Collection;

class ShoppingListBuilder
{
    protected $name;
    protected $products;

    public function __construct() {
        $this->name = '';
        $this->products = new Collection;
    }

    public static function new(): self {
        return new self;
    }

    public static function anyBuilt(): ShoppingList {
        return self::new()->build();
    }

    public function build(): ShoppingList {
        $list = new ShoppingList($this->name);
        $list->addProducts($this->products);

        return $list;
    }

    /*
     * Withs
     */

    public function withName(string $name): self {
        $this->name = $name;
        return $this;
    }

}