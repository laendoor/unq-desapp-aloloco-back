<?php
namespace App\Model\ShoppingList\State;

use App\Model\ShoppingList\State;

class DeliveryList extends State
{
    public function isDeliveryList(): bool {
        return true;
    }
}