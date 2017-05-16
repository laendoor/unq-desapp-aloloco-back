<?php
namespace App\Model\Product;

use App\Model\ShoppingList;
use App\Model\Product\State\Wished;
use App\Model\Product\State\ProductStateBehavior;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class WishedProduct
 * @package App\Model\Product
 *
 * @ORM\Entity
 */
class WishedProduct extends Product
{
    use ProductStateBehavior;

    /**
     * @ORM\Column(type="integer")
     */
    protected $quantity;

    /**
     * Many Products have One ShoppingList
     * @ORM\ManyToOne(targetEntity="\App\Model\ShoppingList", inversedBy="wishedProducts")
     */
    protected $shoppingList;

    public function __construct(string $name, string $brand,
                                Price $price, int $quantity, string $image = '')
    {
        parent::__construct($name, $brand, $price, $image);

        $this->state    = new Wished;
        $this->quantity = $quantity;
    }

    /**
     * @return ShoppingList
     */
    public function getShoppingList(): ShoppingList {
        return $this->shoppingList;
    }

    /**
     * @param ShoppingList $shoppingList
     */
    public function setShoppingList(ShoppingList $shoppingList):void {
        $this->shoppingList = $shoppingList;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

}