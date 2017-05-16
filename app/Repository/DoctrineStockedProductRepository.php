<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineStockedProductRepository
 * @package App\Repository
 */
class DoctrineStockedProductRepository
    extends EntityRepository
    implements StockedProductRepository {

    public function findByNameAndBrand(string $name, string $brand) {
        return $this->findOneBy([
            'name' => $name,
            'brand' => $brand
        ]);
    }
}