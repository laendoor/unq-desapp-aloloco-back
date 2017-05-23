<?php
namespace App\Repository;

use App\Model\Product\Product;

/**
 * Interface ProductRepository
 * @package Repository
 */
interface ProductRepository
{
    public function find($id);
    public function findByNameAndBrand(string $name, string $brand);
    public function save(Product $product);
}