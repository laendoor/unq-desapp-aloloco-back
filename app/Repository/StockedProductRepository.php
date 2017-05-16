<?php
namespace App\Repository;

/**
 * Interface StockedProductRepository
 * @package Repository
 */
interface StockedProductRepository
{
    public function find($id);
    public function findByNameAndBrand(string $name, string $brand);
}