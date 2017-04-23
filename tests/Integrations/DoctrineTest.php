<?php

namespace Tests\Integrations;

use App\Model\Product\Price;
use App\Model\Product\Product;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Tests\TestCase;

class DoctrineTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_stores_and_reads_a_model_from_the_database(): void
    {
        // Arrange
        $price = new Price(44, 50);
        $lays_fries = new Product('Papas Fritas', 'Lays', $price, 'lays.jpg');

        // Act
        EntityManager::persist($lays_fries);
        EntityManager::flush();

        // Assert
        $database_product = EntityManager::find(Product::class, 1);
        $this->assertEquals('Papas Fritas', $database_product->getName());
        $this->assertEquals('Lays', $database_product->getBrand());

        // Fixme: Esto deberia borrarse automaticamente como suele hacerse usando el trait DatabaseTransaction que en este caso con Doctrine es totalmente ignorado
        EntityManager::remove($database_product);
        EntityManager::flush();
    }
}