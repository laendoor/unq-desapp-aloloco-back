<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\State;

class WishList extends State
{
    public function isWishList(): bool {
        return true;
    }
}