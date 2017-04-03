<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\State;

class PurchasedList extends State
{
    public function isPurchasedList(): bool {
        return true;
    }
}