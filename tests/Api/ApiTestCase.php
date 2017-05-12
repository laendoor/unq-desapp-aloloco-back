<?php

namespace Tests\Api;

use Tests\TestCase;
use Tests\DatabaseMigrations;

abstract class ApiTestCase extends TestCase
{
    use DatabaseMigrations;
}
