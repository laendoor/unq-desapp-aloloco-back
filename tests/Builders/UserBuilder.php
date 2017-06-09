<?php
namespace Tests\Builders;

use Mockery;
use App\Model\User;
use App\Model\Admin;
use App\Model\Market;
use App\Model\Threshold;
use App\Model\ShoppingList;
use Doctrine\Common\Collections\ArrayCollection;

class UserBuilder
{
    protected $email;
    protected $market;
    protected $address;
    protected $username;
    protected $googleId;
    protected $setOfLists;
    protected $thresholds;

    public function __construct() {
        $this->email = 'none';
        $this->username = 'none';
        $this->address  = 'none';
        $this->googleId = 0;
        $this->setOfLists = new ArrayCollection;
        $this->thresholds = new ArrayCollection;
    }

    public static function new(): self {
        return new self;
    }

    public static function newWithMocks(): self {
        return self::new()
            ->withMarket(Mockery::mock(Market::class));
    }

    public static function anyUserBuiltWithMocks(): User {
        return self::newWithMocks()->build();
    }

    public function build(): User {
        $user = new User($this->market, $this->email);

        $user->setAddress($this->address);
        $user->setUsername($this->username);
        $user->setGoogleId($this->googleId);

        $this->setOfLists->forAll(function ($key, $list) use ($user) {
            $user->addShoppingList($list);
        });

        $this->thresholds->forAll(function ($key, $th) use ($user) {
            $user->addThreshold($th);
        });

        return $user;
    }

    public function buildAdmin(): Admin {
        return new Admin($this->market, $this->email);
    }

    /*
     * Withs
     */

    public function withMarket(Market $market): self {
        $this->market = $market;
        return $this;
    }

    public function withEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function withUsername(string $username): self {
        $this->username = $username;
        return $this;
    }

    public function withAddress(string $address): self {
        $this->address = $address;
        return $this;
    }

    public function withGoogleId(string $googleId): self {
        $this->googleId = $googleId;
        return $this;
    }

    public function withShoppingList(ShoppingList $list): self {
        $this->setOfLists->add($list);
        return $this;
    }

    public function withThreshold(Threshold $threshold): self {
        $this->thresholds->add($threshold);
        return $this;
    }

}