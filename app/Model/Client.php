<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Collection;

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
     * @var Collection<ShoppingList>
     */
    protected $setOfLists;

    /**
     * Client constructor.
     * @param Market $market
     */
    public function __construct(Market $market) {
        $this->market = $market;
        $this->setOfLists  = new Collection;
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
        $this->setOfLists->push($list);
    }

    public function removeList(ShoppingList $listToRemove): void {
        $this->setOfLists = $this->setOfLists->reject(
            function (ShoppingList $list) use ($listToRemove) {
                return $list->equals($listToRemove);
            }
        );
    }

    /**
     * @return Collection
     */
    public function getSetOfLists(): Collection {
        return $this->setOfLists;
    }
}