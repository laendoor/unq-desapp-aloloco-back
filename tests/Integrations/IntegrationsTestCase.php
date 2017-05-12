<?php
namespace Tests\Integrations;

use Tests\TestCase;
use Tests\DatabaseMigrations;

abstract class IntegrationsTestCase extends TestCase
{
    use DatabaseMigrations;
}
