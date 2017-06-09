<?php
namespace App\Repository;

/**
 * Interface ShoppingListRepository
 * @package Repository
 */
interface ShoppingListRepository
{
    public function find($id);
    public function findByUserId($id): array;
    public function findPurchasedByUserId($id): array;
}