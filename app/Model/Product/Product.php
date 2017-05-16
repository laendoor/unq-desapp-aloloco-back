<?php
namespace App\Model\Product;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $brand;

    /**
     * @var Price
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $image;

    public function __construct(string $name, string $brand,
                                Price $price, string $image = '')
    {
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->image = $image;
    }

    /*
     * Getters
     */

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    /*
     * Comparing
     */

    public function equals(Product $another): bool
    {
        return $this->getName() == $another->getName()
            && $this->getBrand() == $another->getBrand();
    }
}