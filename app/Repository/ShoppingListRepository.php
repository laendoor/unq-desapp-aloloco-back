<?php namespace App\Repository;

use App\Model\ShoppingList;

/**
 * Interface ShoppingListRepository
 * @package Repository
 */
interface ShoppingListRepository
{
    public function save(ShoppingList $list);
    public function find($id);
    public function findByUserId($id): array;
    public function findPurchasedByUserId($id): array;
}