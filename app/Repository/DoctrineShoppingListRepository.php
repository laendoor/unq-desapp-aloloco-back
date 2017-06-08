<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineShoppingListRepository
 * @package App\Repository
 */
class DoctrineShoppingListRepository
    extends EntityRepository implements ShoppingListRepository {

    public function findByClientId($id): array
    {
        $query = $this->_em->createQuery('SELECT wl FROM App\Model\ShoppingList wl');

        return $query->getResult();
    }

    public function findPurchasedByClientId($id): array
    {
        $query = $this->_em->createQuery('SELECT wl FROM App\Model\ShoppingList wl');

        return $query->getResult();
    }
}