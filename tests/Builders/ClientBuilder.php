<?php
namespace Tests\Builders;

use Mockery;
use App\Model\Market;
use App\Model\Client;

class ClientBuilder
{
    protected $market;

    public static function new(): self {
        return new self;
    }

    public static function anyBuiltWithMocks(): Client {
        return self::new()
            ->withMarket(Mockery::mock(Market::class))
            ->build();
    }

    public function build(): Client {
        return new Client($this->market);
    }

    public function withMarket(Market $market): self {
        $this->market = $market;
        return $this;
    }
}