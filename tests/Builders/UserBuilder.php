<?php
namespace Tests\Builders;

use Mockery;
use App\Model\Admin;
use App\Model\Market;
use App\Model\Client;
use App\Model\Threshold;
use App\Model\ShoppingList;
use Doctrine\Common\Collections\ArrayCollection;

class UserBuilder
{
    protected $email;
    protected $market;
    protected $setOfLists;
    protected $thresholds;

    public function __construct() {
        $this->email = 'none';
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

    public static function anyClientBuiltWithMocks(): Client {
        return self::newWithMocks()->buildClient();
    }

    public function buildClient(): Client {
        $client = new Client($this->market, $this->email);

        $this->setOfLists->forAll(function ($key, $list) use ($client) {
            $client->addList($list);
        });

        $this->thresholds->forAll(function ($key, $th) use ($client) {
            $client->addThreshold($th);
        });

        return $client;
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

    public function withShoppingList(ShoppingList $list): self {
        $this->setOfLists->add($list);
        return $this;
    }

    public function withThreshold(Threshold $threshold): self {
        $this->thresholds->add($threshold);
        return $this;
    }

}