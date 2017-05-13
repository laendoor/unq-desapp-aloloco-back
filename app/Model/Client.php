<?php
namespace App\Model;

use App\Model\Product\WishedProduct;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Client
 * @package App\Model
 *
 * @ORM\Entity
 */
class Client extends User
{
    /**
     * One Client has Many ShoppingLists
     * @var ArrayCollection|ShoppingList[]
     * @ORM\OneToMany(targetEntity="ShoppingList", mappedBy="client")
     */
    protected $shoppingLists;

    /**
     * @var ArrayCollection<GeneralThreshold>
     */
    protected $thresholds;

    /**
     * Client constructor.
     * @param Market $market
     * @param string $email
     */
    public function __construct(Market $market, string $email) {
        parent::__construct($market, $email);
        $this->thresholds = new ArrayCollection;
        $this->shoppingLists = new ArrayCollection;
    }

    /**
     * @param ShoppingList $list
     */
    public function addShoppingList(ShoppingList $list): void {
        $this->shoppingLists->add($list);
    }

    /**
     * @param ShoppingList $listToRemove
     */
    public function removeList(ShoppingList $listToRemove): void {
        $this->getShoppingLists()->removeElement($listToRemove);
    }

    /**
     * @return ArrayCollection
     */
    public function getShoppingLists(): ArrayCollection {
        return $this->shoppingLists;
    }

    /**
     * @param WishedProduct $product
     * @param ShoppingList $list
     */
    public function addProduct(WishedProduct $product, ShoppingList $list): void {
        $set   = $this->getShoppingLists();
        $index = $set->indexOf($list);
        if ($index !== false) {
            $set->get($index)->addProduct($product);
        }
    }

    /**
     * @param WishedProduct $product
     * @param ShoppingList $list
     */
    public function removeProduct(WishedProduct $product, ShoppingList $list): void {
        $set   = $this->getShoppingLists();
        $index = $set->indexOf($list);
        if ($index !== false) {
            $set->get($index)->removeProduct($product);
        }
    }

    /**
     * @param Threshold $threshold
     */
    public function addThreshold(Threshold $threshold): void {
        $this->thresholds->add($threshold);
    }

    /**
     * @param Threshold $threshold
     */
    public function removeThreshold(Threshold $threshold): void {
        $this->getThresholds()->removeElement($threshold);
    }

    /**
     * @return ArrayCollection
     */
    public function getThresholds(): ArrayCollection {
        return $this->thresholds;
    }

    public function goToTheMarket(ShoppingList $list): void {
        $list->markAsMarket();
    }

    public function checkProduct(WishedProduct $product, ShoppingList $list): void {
        $list->addToCart($product);
    }

    public function uncheckProduct(WishedProduct $product, ShoppingList $list): void {
        $list->removeFromCart($product);
    }

    public function requestBox(ShoppingList $list): int {
        return $this->market->estimatedWaitingTime($list);
    }

    public function goToTheBox(Box $box, ShoppingList $list): void {
        $this->market->goingToBox($box, $this, $list);
    }

    public function buyList(Box $box, ShoppingList $list): void {
        $this->removeList($list);
        $list->markAsPurchased();
        $this->addShoppingList($list);
        $this->market->purchaseMade($box, $this, $list);
    }

    public function requestForDelivery(Box $box, ShoppingList $list): void {
        $this->removeList($list);
        $list->markAsDelivery();
        $this->addShoppingList($list);
        $this->market->deliveryRequest($box, $this, $list);
    }
}