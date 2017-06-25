<?php
namespace App\Model;

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
    protected $id;

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
     * @ORM\Column(type="integer")
     */
    protected $stock;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $image;
    /**
     * @var Price
     * Many Products have One Price
     * @ORM\ManyToOne(targetEntity="\App\Model\Price", inversedBy="products", cascade={"persist"})
     */
    protected $price;
    /**
     * One Product has Many WishedProducts
     * @var Collection|WishedProduct[]
     * @ORM\OneToMany(targetEntity="\App\Model\WishedProduct", mappedBy="product", cascade={"persist"})
     */
    protected $wishedProducts;

    public function __construct(string $name = '', string $brand = '',
                                Price $price = null, int $stock = 0, string $image = '')
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
    public function setStock($stock)
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

    public function __toString()
    {
        return self::class . "({$this->id},{$this->name},{$this->brand})";
    }

    /**
     * @param string $image
     */
    public function setImage(string $image) {
        $this->image = $image;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param Price $price
     */
    public function setPrice(Price $price)
    {
        $this->price = $price;
    }
}