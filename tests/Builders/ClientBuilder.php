<?php
namespace Tests\Builders;

use Mockery;
use App\Model\Market;
use App\Model\Client;
use App\Model\Threshold;
use App\Model\ShoppingList;
use Illuminate\Support\Collection;

class ClientBuilder
{
    protected $market;
    protected $setOfLists;
    protected $thresholds;

    public function __construct() {
        $this->setOfLists = new Collection;
        $this->thresholds = new Collection;
    }

    public static function new(): self {
        return new self;
    }

    public static function newWithMocks(): self {
        return self::new()
            ->withMarket(Mockery::mock(Market::class));
    }

    public static function anyBuiltWithMocks(): Client {
        return self::newWithMocks()->build();
    }

    public function build(): Client {
        $client = new Client($this->market);

        $this->setOfLists->each(function ($list) use ($client) {
            $client->addList($list);
        });

        $this->thresholds->each(function ($th) use ($client) {
            $client->addThreshold($th);
        });

        return $client;
    }

    /*
     * Withs
     */

    public function withMarket(Market $market): self {
        $this->market = $market;
        return $this;
    }

    public function withShoppingList(ShoppingList $list): self {
        $this->setOfLists->push($list);
        return $this;
    }

    public function withThreshold(Threshold $threshold): self {
        $this->thresholds->push($threshold);
        return $this;
    }

}