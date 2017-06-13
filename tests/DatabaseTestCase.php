<?php

namespace Tests;

use Artisan;

abstract class DatabaseTestCase extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    protected function tearDown()
    {
        Artisan::call('migrate:rollback');

        parent::tearDown();
    }
}
