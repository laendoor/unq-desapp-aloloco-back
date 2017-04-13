<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\ShoppingListState;

class MarketList extends ShoppingListState
{
    public function isMarketList(): bool {
        return true;
    }
}