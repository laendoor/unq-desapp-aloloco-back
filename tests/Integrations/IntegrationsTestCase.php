<?php
namespace Tests\Integrations;

use Tests\DatabaseTestCase;

abstract class IntegrationsTestCase extends DatabaseTestCase
{
    /**
     * @var ObjectRepository
     */
    protected $repo;
}
