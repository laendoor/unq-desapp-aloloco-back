<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\State;

class MarketList extends State
{
    public function isMarketList(): bool {
        return true;
    }
}