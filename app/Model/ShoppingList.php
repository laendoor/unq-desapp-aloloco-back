<?php
namespace App\Model;

use Illuminate\Support\Collection;
use App\Model\ShoppingList\State\WishList;
use App\Model\ShoppingList\State\MarketList;
use App\Model\ShoppingList\State\DeliveryList;
use App\Model\ShoppingList\State\PurchasedList;

/**
 * Class ShoppingList
 * @package App\Model
 */
class ShoppingList
{
    protected $name;
    protected $state;
    protected $products;

    /**
     * ShoppingList constructor.
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name     = $name;
        $this->state    = new WishList;
        $this->products = new Collection;
    }

    /*
     * State Actions
     */

    public function markAsMarket(): void {
        $this->state = new MarketList;
    }

    public function markAsPurchased(): void {
        $this->state = new PurchasedList;
    }

    public function markAsDelivery(): void {
        $this->state = new DeliveryList;
    }

    public function markAsWish(): void {
        $this->state = new WishList;
    }

    /*
     * State dependent methods
     */

    public function isWishList(): bool {
        return $this->state->isWishList();
    }

    public function isMarketList(): bool {
        return $this->state->isMarketList();
    }

    public function isPurchasedList(): bool {
        return $this->state->isPurchasedList();
    }

    public function isDeliveryList(): bool {
        return $this->state->isDeliveryList();
    }

    /*
     * Products Manipulation
     */

    public function getProducts(): Collection {
        return $this->products;
    }

    public function addProduct(Product $product): void {
        $this->products->push($product);
    }

    public function removeProduct(Product $product): void {
        $this->products = $this->products->reject(function (Product $item) use ($product) {
            return $item->equals($product);
        });
    }

    public function addProducts(Collection $moreProducts): void {
        $this->products->merge($moreProducts);
    }

    /*
     * Getters & Setters
     */

    public function getName(): string {
        return $this->name;
    }

    public function equals(ShoppingList $another): bool {
        return $this->getName() == $another->getName();
    }
}