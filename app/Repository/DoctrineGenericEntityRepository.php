<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class GenericEntityRepository
 * @package App\Repository
 */
class DoctrineGenericEntityRepository
    extends EntityRepository implements GenericEntityRepository {

    public function save($entity): void {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}