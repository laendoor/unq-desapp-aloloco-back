<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\ShoppingListState;

class DeliveryList extends ShoppingListState
{
    public function isDeliveryList(): bool {
        return true;
    }
}