<?php
namespace App\Model;

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
     * Client constructor.
     * @param Market $market
     */
    public function __construct(Market $market) {
        $this->market = $market;
        $this->setOfLists  = new ArrayCollection;
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

    public function removeList(ShoppingList $listToRemove): void {
        $this->getSetOfLists()->removeElement($listToRemove);
    }

    /**
     * @return ArrayCollection
     */
    public function getSetOfLists(): ArrayCollection {
        return $this->setOfLists;
    }

    public function addProduct(Product $product, ShoppingList $list): void {
        $set   = $this->getSetOfLists();
        $index = $set->indexOf($list);
        if ($index !== false) {
            $set->get($index)->addProduct($product);
        }
        // FIXME? throws exception if set not contains list??
    }
}