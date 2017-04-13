<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\ShoppingListState;

class PurchasedList extends ShoppingListState
{
    public function isPurchasedList(): bool {
        return true;
    }
}