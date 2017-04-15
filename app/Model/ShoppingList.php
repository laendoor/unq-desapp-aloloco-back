<?php
namespace App\Model;

use App\Model\Product\WishedProduct;
use App\Model\ShoppingList\State\WishList;
use App\Model\ShoppingList\State\MarketList;
use App\Model\ShoppingList\State\DeliveryList;
use App\Model\ShoppingList\State\PurchasedList;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ShoppingList
 * @package App\Model
 */
class ShoppingList
{
    protected $name;
    protected $state;
    protected $wish_products;

    /**
     * ShoppingList constructor.
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name     = $name;
        $this->state    = new WishList;
        $this->wish_products = new ArrayCollection;
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

    public function getWishProducts(): ArrayCollection {
        return $this->wish_products;
    }

    public function addProduct(WishedProduct $product): void {
        $this->wish_products->add($product);
    }

    public function removeProduct(WishedProduct $product): void {
        $this->getWishProducts()->removeElement($product);
    }

    public function addProducts(ArrayCollection $moreProducts): void {
        $moreProducts->forAll(function ($newProduct) {
            $this->addProduct($newProduct);
        });
    }

    public function addToCart(WishedProduct $product): void {
        $product->addedToCart();
    }

    public function removeFromCart(WishedProduct $product): void {
        $product->removedFromCart();
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