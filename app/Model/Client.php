<?php
namespace App\Model;

use App\Model\Product\WishedProduct;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Client
 * @package App\Model
 */
class Client extends User
{
    /**
     * @var ArrayCollection<ShoppingList>
     */
    protected $setOfLists;

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
        $this->setOfLists = new ArrayCollection;
    }

    /**
     * @param ShoppingList $list
     */
    public function addList(ShoppingList $list): void {
        $this->setOfLists->add($list);
    }

    /**
     * @param ShoppingList $listToRemove
     */
    public function removeList(ShoppingList $listToRemove): void {
        $this->getSetOfLists()->removeElement($listToRemove);
    }

    /**
     * @return ArrayCollection
     */
    public function getSetOfLists(): ArrayCollection {
        return $this->setOfLists;
    }

    /**
     * @param WishedProduct $product
     * @param ShoppingList $list
     */
    public function addProduct(WishedProduct $product, ShoppingList $list): void {
        $set   = $this->getSetOfLists();
        $index = $set->indexOf($list);
        if ($index !== false) {
            $set->get($index)->addProduct($product);
        }
        // FIXME? throws exception if set not contains list??
    }

    /**
     * @param WishedProduct $product
     * @param ShoppingList $list
     */
    public function removeProduct(WishedProduct $product, ShoppingList $list): void {
        $set   = $this->getSetOfLists();
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
}