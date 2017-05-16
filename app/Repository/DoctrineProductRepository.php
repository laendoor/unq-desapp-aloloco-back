<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineProductRepository
 * @package App\Repository
 */
class DoctrineProductRepository
    extends EntityRepository
    implements ProductRepository {

    public function findByNameAndBrand(string $name, string $brand) {
        return $this->findOneBy([
            'name' => $name,
            'brand' => $brand
        ]);
    }
}