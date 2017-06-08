<?php
namespace App\Repository;

/**
 * Interface ShoppingListRepository
 * @package Repository
 */
interface ShoppingListRepository
{
    public function find($id);
    public function findByClientId($id): array;
    public function findPurchasedByClientId($id): array;
}