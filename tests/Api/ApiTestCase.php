<?php

namespace Tests\Api;

use App\Model\Product;
use App\Model\ShoppingList;
use App\Model\WishedProduct;
use App\Repository\ShoppingListRepository;
use Dingo\Api\Dispatcher;
use Tests\DatabaseTestCase;

abstract class ApiTestCase extends DatabaseTestCase
{
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->api = app(Dispatcher::class);
    }

    protected function addProductToList(ShoppingList $list, Product $product, $quantity)
    {
        $repo = resolve(ShoppingListRepository::class);
        $list->addProduct(new WishedProduct($product, $quantity));
        $repo->save($list);
    }
}
