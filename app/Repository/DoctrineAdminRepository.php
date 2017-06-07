<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineAdminRepository
 * @package App\Repository
 */
class DoctrineAdminRepository
    extends EntityRepository
    implements AdminRepository {

}