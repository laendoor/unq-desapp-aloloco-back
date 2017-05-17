<?php
namespace App\Repository;

use App\Model\Product\StockedProduct;

/**
 * Interface StockedProductRepository
 * @package Repository
 */
interface StockedProductRepository
{
    public function find($id);
    public function findByNameAndBrand(string $name, string $brand);
    public function save(StockedProduct $product);
}