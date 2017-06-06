<?php
namespace App\Repository;

use App\Model\Product;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineProductRepository
 * @package App\Repository
 */
class DoctrineProductRepository
    extends EntityRepository
    implements ProductRepository {

    public function findByNameAndBrand(string $name, string $brand)
    {
        return $this->findOneBy([
            'name' => $name,
            'brand' => $brand
        ]);
    }

    public function save(Product $product)
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }
}