<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Market
 * @package App\Model
 *
 * @ORM\Entity
 */
class Market
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var ArrayCollection<Box>
     */
    protected $boxes;

    /**
     * @var ArrayCollection<Product>
     */
    protected $products;

    public function __construct() {
        $this->boxes = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * @return ArrayCollection<Product>
     */
    public function getStock(): ArrayCollection {
        return $this->products;
    }

    /**
     * @return void
     */
    public function cleanStock(): void {
        $this->products->clear();
    }

    /**
     * @param Product $product
     *
     * @return void
     */
    public function addProduct(Product $product): void {
        $this->products->add($product);
    }

    /**
     * @param Box $box
     *
     * @return void
     */
    public function addBox(Box $box): void {
        $this->boxes->add($box);
    }

    /**
     * @param ShoppingList $list
     * @return int
     */
    public function estimatedWaitingTime(ShoppingList $list): int {
        $enabled_boxes = $this->boxes->filter(function (Box $box) {
            return $box->isEnabled();
        });

        $box_times = $enabled_boxes->map(function (Box $box) {
            return $box->estimatedWaitingTime();
        })->toArray();

        return array_sum($box_times) / count($box_times);
    }

    public function goingToBox(Box $box, User $user, ShoppingList $list): void {
    }

    public function purchaseMade(Box $box, User $user, ShoppingList $list): void {
    }

    public function deliveryRequest(Box $box, User $user, ShoppingList $list): void {
    }
}