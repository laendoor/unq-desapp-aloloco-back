<?php
namespace App\Repository;

use App\Model\Product\StockedProduct;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineStockedProductRepository
 * @package App\Repository
 */
class DoctrineStockedProductRepository
    extends EntityRepository
    implements StockedProductRepository {

    public function findByNameAndBrand(string $name, string $brand)
    {
        return $this->findOneBy([
            'name' => $name,
            'brand' => $brand
        ]);
    }

    public function save(StockedProduct $product)
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }
}