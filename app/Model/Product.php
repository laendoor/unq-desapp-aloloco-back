<?php
namespace App\Model;

use App\Model\Product\Price;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="products")
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
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $image;

    /**
     * One Product has Many WishedProducts
     * @var Collection|WishedProduct[]
     * @ORM\OneToMany(targetEntity="\App\Model\Product\WishedProduct", mappedBy="product", cascade={"persist"})
     */
    protected $wishedProducts;

    public function __construct(string $name, string $brand,
                                Price $price, int $stock, string $image = '')
    {
        $this->name = $name;
        $this->brand = $brand;
        $this->price = $price;
        $this->stock = $stock;
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

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
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