<?php namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProductCategory
 * @package Tests\Unit
 *
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class ProductCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
}