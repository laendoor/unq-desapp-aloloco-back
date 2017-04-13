<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\ShoppingListState;

class WishList extends ShoppingListState
{
    public function isWishList(): bool {
        return true;
    }
}