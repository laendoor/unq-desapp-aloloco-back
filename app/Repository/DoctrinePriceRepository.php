<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrinePriceRepository
 * @package App\Repository
 */
class DoctrinePriceRepository
    extends EntityRepository
    implements PriceRepository {
}