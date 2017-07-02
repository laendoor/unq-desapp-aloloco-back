<?php
namespace Tests\Integrations;

use App\Model\Product;
use App\Model\Price;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ProductTest extends IntegrationsTestCase
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
        $lays_fries = new Product('Papas Fritas');
        $lays_fries->setBrand('Lays');
        $lays_fries->setPrice($price);
        $lays_fries->setStock(10);
        $lays_fries->setImage('lays.jpg');
        $products_repository = EntityManager::getRepository(Product::class);

        // Act
        EntityManager::persist($lays_fries);
        EntityManager::flush();
        $database_products = $products_repository->findAll();

        // Assert
        $this->assertEquals(1, $database_products[0]->getId());
        $this->assertEquals('Lays', $database_products[0]->getBrand());
        $this->assertEquals('Papas Fritas', $database_products[0]->getName());
        $this->assertEquals($price, $database_products[0]->getPrice());
        $this->assertEquals(Product::class . "(1,Papas Fritas,Lays)", $database_products[0]->__toString());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_stores_and_reads_a_model_from_the_database_using_factories(): void
    {
        // Arrange
        $repository = EntityManager::getRepository(Product::class);
        entity(Product::class)->create([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'image' => 'lays.jpg'
        ]);

        // Act
        $product = $repository->findOneByBrand('Lays');

        // Assert
        $this->assertEquals(1, count($repository->findAll()));
        $this->assertEquals('Papas Fritas', $product->getName());
        $this->assertEquals('Lays', $product->getBrand());
        $this->assertEquals('lays.jpg', $product->getImage());
    }
}