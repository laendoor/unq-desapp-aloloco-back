<?php
namespace Tests\Integrations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class IntegrationsTestCase extends TestCase
{
    use DatabaseMigrations;
}
