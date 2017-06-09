<?php
namespace App\Repository;

use App\Model\Product;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineWishedProductRepository
 * @package App\Repository
 */
class DoctrineWishedProductRepository
    extends EntityRepository
    implements WishedProductRepository {
}