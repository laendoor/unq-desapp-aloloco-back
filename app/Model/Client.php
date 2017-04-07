<?php
namespace App\Model;

use App\Model\Threshold\GeneralThreshold;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Client
 * @package App\Model
 */
class Client
{
    /**
     * @var Market
     */
    protected $market;

    /**
     * @var ArrayCollection<ShoppingList>
     */
    protected $setOfLists;

    /**
     * @var GeneralThreshold
     */
    protected $generalThreshold;

    /**
     * Client constructor.
     * @param Market $market
     * @param GeneralThreshold $threshold
     */
    public function __construct(Market $market, GeneralThreshold $threshold) {
        $this->market = $market;
        $this->generalThreshold = $threshold;
        $this->setOfLists = new ArrayCollection;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market {
        return $this->market;
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
     * @param Product $product
     * @param ShoppingList $list
     */
    public function addProduct(Product $product, ShoppingList $list): void {
        $set   = $this->getSetOfLists();
        $index = $set->indexOf($list);
        if ($index !== false) {
            $set->get($index)->addProduct($product);
        }
        // FIXME? throws exception if set not contains list??
    }

    /**
     * @param Product $product
     * @param ShoppingList $list
     */
    public function removeProduct(Product $product, ShoppingList $list): void {
        $set   = $this->getSetOfLists();
        $index = $set->indexOf($list);
        if ($index !== false) {
            $set->get($index)->removeProduct($product);
        }
    }

    /**
     * @param GeneralThreshold $threshold
     */
    public function setGeneralThreshold(GeneralThreshold $threshold): void {
        $this->generalThreshold = $threshold;
    }

    /**
     * @return GeneralThreshold
     */
    public function getGeneralThreshold(): GeneralThreshold {
        return $this->generalThreshold;
    }
}