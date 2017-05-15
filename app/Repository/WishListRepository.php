<?php
namespace App\Repository;

use Doctrine\Common\Collections\Collection;

/**
 * Interface WishListRepository
 * @package Repository
 */
interface WishListRepository
{
    public function find($id);
    public function findByClientId($id): array;
}