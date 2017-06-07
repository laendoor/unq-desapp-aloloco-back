<?php

namespace Tests\Repository;

use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Tests\TestCase;

/**
 * Class RepositoryTest
 * @package Api
 */
class RepositoryTest extends TestCase
{
    /**
     * All Model Class should have a DoctrineRepository
     * @test
     *
     * @return void
     */
    public function all_model_class_should_have_a_doctrine_repository()
    {
        collect(get_declared_classes())->filter(function ($class)
        {
            return starts_with($class, 'App\\Model\\');

        })->map(function ($class)
        {
            return str_replace('App\\Model\\', '', $class);

        })->reject(function ($class)
        {
            return str_contains($class, '\\');

        })->each(function ($class)
        {
            $repo = resolve('App\\Repository\\'.$class.'Repository');
            $this->assertEquals("App\\Model\\$class", $repo->getClassName());
        });
    }
}
