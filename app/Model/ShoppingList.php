<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Model\Product\WishedProduct;
use App\Model\ShoppingList\State\WishList;
use App\Model\ShoppingList\State\MarketList;
use App\Model\ShoppingList\State\DeliveryList;
use App\Model\ShoppingList\State\PurchasedList;

/**
 * Class ShoppingList
 * @package App\Model
 *
 * @ORM\Entity
 */
class ShoppingList
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
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $slug = 'none'; // FIXME

    protected $state;

    /**
     * One ShoppingList has Many WishedProducts
     * @var Collection|WishedProduct[]
     * @ORM\OneToMany(targetEntity="\App\Model\Product\WishedProduct", mappedBy="shoppingList", cascade={"persist"})
     */
    protected $products;

    /**
     * Many ShoppingLists have One User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="shoppingLists")
     * @var User
     */
    protected $user;

    /**
     * ShoppingList constructor.
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name     = $name;
        $this->state    = new WishList;
        $this->products = new ArrayCollection;
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
        return $this->products ?? new ArrayCollection;
    }

    public function addProduct(WishedProduct $product): void {
        $this->products->add($product);
        $product->setShoppingList($this);
    }

    public function removeProduct(WishedProduct $product): void {
        $this->getProducts()->removeElement($product);
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

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }

    /*
     *
     */

    public function equals(ShoppingList $another): bool {
        return $this->getName() == $another->getName();
    }
}