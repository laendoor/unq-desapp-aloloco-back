<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineShoppingListRepository
 * @package App\Repository
 */
class DoctrineShoppingListRepository
    extends EntityRepository
    implements ShoppingListRepository {

}