<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineWishListRepository
 * @package App\Repository
 */
class DoctrineWishListRepository
    extends EntityRepository
    implements WishListRepository {

    public function findByClientId($id): array
    {
        $query = $this->_em->createQuery('SELECT wl FROM App\Model\ShoppingList wl');

        return $query->getResult();
    }
}