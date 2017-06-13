<?php

namespace Tests\Api;

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
}
