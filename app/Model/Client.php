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
     * @var ShoppingList
     */
    protected $lists;

    /**
     * Client constructor.
     * @param Market $market
     */
    public function __construct(Market $market) {
        $this->market = $market;
        $this->lists  = new Collection;
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
        $this->lists->push($list);
    }

    /**
     * @return Collection
     */
    public function getLists(): Collection {
        return $this->lists;
    }
}