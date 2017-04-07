<?php
namespace Tests\Builders;

use Mockery;
use App\Model\Market;
use App\Model\Client;
use Illuminate\Support\Collection;
use App\Model\Threshold\GeneralThreshold;

class ClientBuilder
{
    protected $market;
    protected $setOfLists;
    protected $generalThreshold;

    public function __construct() {
        $this->setOfLists = new Collection;
    }

    public static function new(): self {
        return new self;
    }

    public static function newWithMocks(): self {
        return self::new()
            ->withMarket(Mockery::mock(Market::class))
            ->withGeneralThreshold(Mockery::mock(GeneralThreshold::class));
    }

    public static function anyBuiltWithMocks(): Client {
        return self::newWithMocks()->build();
    }

    public function build(): Client {
        $client = new Client($this->market, $this->generalThreshold);

        $this->setOfLists->each(function ($list) use ($client) {
            $client->addList($list);
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

    public function withShoppingList($list): self {
        $this->setOfLists->push($list);
        return $this;
    }

    public function withGeneralThreshold(GeneralThreshold $threshold): self {
        $this->generalThreshold = $threshold;
        return $this;
    }
}