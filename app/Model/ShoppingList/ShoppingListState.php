<?php

namespace App\Model\ShoppingList;


abstract class ShoppingListState
{
    public function isWishList(): bool {
        return false;
    }

    public function isMarketList(): bool {
        return false;
    }

    public function isPurchasedList(): bool {
        return false;
    }

    public function isDeliveryList(): bool {
        return false;
    }
}