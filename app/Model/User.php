<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 * @package App\Model
 *
 * @ORM\Entity
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $username;
    /**
     * @ORM\Column(type="string")
     */
    private $google_id;

    /**
     * @var Market
     */
    protected $market;

    /**
     * One User has Many ShoppingLists
     * @var Collection|ShoppingList[]
     * @ORM\OneToMany(targetEntity="ShoppingList", mappedBy="user", cascade={"persist"})
     */
    protected $shoppingLists;

    /**
     * @var Collection<GeneralThreshold>
     */
    protected $thresholds;

    /**
     * User constructor.
     * @param Market $market
     * @param string $email
     * @param string $username
     * @param string $google_id
     */
    public function __construct(Market $market, string $email, string $username, string $google_id = '') {
        $this->email  = $email;
        $this->market = $market;
        $this->username = $username;
        $this->google_id = $google_id;
        $this->thresholds = new ArrayCollection;
        $this->shoppingLists = new ArrayCollection;
    }

    /**
     * @param ShoppingList $list
     */
    public function addShoppingList(ShoppingList $list): void {
        $list->setUser($this);
        $this->shoppingLists->add($list);
    }

    /**
     * @param ShoppingList $listToRemove
     */
    public function removeList(ShoppingList $listToRemove): void {
        $this->getShoppingLists()->removeElement($listToRemove);
    }

    /**
     * @return Collection
     */
    public function getShoppingLists(): Collection {
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
     * @return Collection
     */
    public function getThresholds(): Collection {
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

    /*
     * Getters
     */

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market {
        return $this->market;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }
}