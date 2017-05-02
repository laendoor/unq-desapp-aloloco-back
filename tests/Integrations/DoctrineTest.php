<?php
namespace Tests\Integrations;

use App\Model\Product\Price;
use App\Model\Product\Product;
use LaravelDoctrine\ORM\Facades\EntityManager;

class DoctrineTest extends IntegrationsTestCase
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
        $products_repository = EntityManager::getRepository(Product::class);

        // Act
        EntityManager::persist($lays_fries);
        EntityManager::flush();
        $database_products = $products_repository->findAll();

        // Assert
        $this->assertEquals('Papas Fritas', $database_products[0]->getName());
        $this->assertEquals('Lays', $database_products[0]->getBrand());

        // Fixme: Esto deberia borrarse automaticamente como suele hacerse usando el trait DatabaseTransaction que en este caso con Doctrine es totalmente ignorado
        EntityManager::remove($database_products[0]);
        EntityManager::flush();
    }
}