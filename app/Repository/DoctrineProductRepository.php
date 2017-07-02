<?php
namespace App\Repository;

use App\Model\Product;
use App\Model\ShoppingList;
use App\Model\WishedProduct;
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

    /**
     * Get products that area related with productId passed by parameter.
     *
     * Product is related when is on any Shopping List with product-parameter;
     *
     * @param int $id
     * @return static
     */
    public function findRelatedTo(int $id)
    {
        $product = $this->find($id);

        $query = $this->_em->createQuery("SELECT sl FROM App\Model\ShoppingList sl");

        $lists = $query->getResult();

        $lists = collect($lists)->filter(function (ShoppingList $list) use ($product) {
            $products = collect($list->getProducts()->toArray())->map(function ($product) {
                return $product->getName();
            });
            return $products->contains($product->getName());
        });

        $products = $lists->map(function (ShoppingList $list) {
            return collect($list->getProducts()->toArray());
        })->flatten()->reject(function (WishedProduct $related) use ($product) {
            return $related->getName() == $product->getName();
        })->map(function (WishedProduct $related) {
            return $related->getProduct();
        });

        return $products;
    }

    public function save(Product $product)
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }

    public function trySaveWithErrors(Product $product)
    {
        $product->setStock(null);

        $this->_em->persist($product);
        $this->_em->flush();
    }
}