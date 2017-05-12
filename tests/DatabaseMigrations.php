<?php

namespace Tests;

use Artisan;

trait DatabaseMigrations
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
