<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineClientRepository
 * @package App\Repository
 */
class DoctrineClientRepository
    extends EntityRepository
    implements ClientRepository {

}