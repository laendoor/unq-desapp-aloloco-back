<?php
namespace App\Repository;

/**
 * Interface ProductRepository
 * @package Repository
 */
interface ProductRepository
{
    public function find($id);
    public function findByNameAndBrand(string $name, string $brand);
}