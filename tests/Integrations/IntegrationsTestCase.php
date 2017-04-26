<?php
namespace Tests\Integrations;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

abstract class IntegrationsTestCase extends TestCase
{
    use DatabaseMigrations;
}
