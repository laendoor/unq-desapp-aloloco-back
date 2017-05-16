<?php
namespace App\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Model\Product\WishedProduct;
use App\Model\ShoppingList\State\WishList;
use App\Model\ShoppingList\State\MarketList;
use App\Model\ShoppingList\State\DeliveryList;
use App\Model\ShoppingList\State\PurchasedList;
use Doctrine\Common\Collections\ArrayCollection;

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
    protected $wishedProducts;

    /**
     * Many ShoppingLists have One Client
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="shoppingLists")
     * @var Client
     */
    protected $client;

    /**
     * ShoppingList constructor.
     * @param string $name
     */
    public function __construct(string $name) {
        $this->name     = $name;
        $this->state    = new WishList;
        $this->wishedProducts = new ArrayCollection;
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

    public function getWishedProducts(): Collection {
        return $this->wishedProducts ?? new ArrayCollection;
    }

    public function addWishedProduct(WishedProduct $product): void {
        $this->wishedProducts->add($product);
        $product->setShoppingList($this);
    }

    public function removeWishedProduct(WishedProduct $product): void {
        $this->getWishedProducts()->removeElement($product);
    }

    public function addWishedProducts(ArrayCollection $moreProducts): void {
        $moreProducts->forAll(function ($newProduct) {
            $this->addWishedProduct($newProduct);
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
     * @return Client
     */
    public function getClient(): Client {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void {
        $this->client = $client;
    }

    /*
     *
     */

    public function equals(ShoppingList $another): bool {
        return $this->getName() == $another->getName();
    }
}