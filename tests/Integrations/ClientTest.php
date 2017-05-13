<?php
namespace Tests\ORM;

use App\Model\Client;
use Tests\Builders\UserBuilder;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Tests\Integrations\IntegrationsTestCase;

class ClientTest extends IntegrationsTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_can_map_a_basic_client(): void
    {
        // Arrange
        $dany = UserBuilder::newWithMocks()
            ->withEmail('mother.of.dragons@seven-kingdoms.org')
            ->buildClient();

        $repo = EntityManager::getRepository(Client::class);

        // Act
        EntityManager::persist($dany);
        EntityManager::flush();
        $dany_db = collect($repo->findAll())->first();

        // Assert
        $this->assertEquals('mother.of.dragons@seven-kingdoms.org', $dany_db->getEmail());
    }

//    /**
//     * @test
//     *
//     * @return void
//     */
//    public function it_stores_and_reads_a_model_from_the_database_using_factories(): void
//    {
//        // Arrange
//        $repository = EntityManager::getRepository(Product::class);
//        entity(Product::class)->create([
//            'name'  => 'Papas Fritas',
//            'brand' => 'Lays',
//            'image' => 'lays.jpg'
//        ]);
//
//        // Act
//        $product = $repository->findOneByBrand('Lays');
//
//        // Assert
//        $this->assertEquals(1, count($repository->findAll()));
//        $this->assertEquals('Papas Fritas', $product->getName());
//        $this->assertEquals('Lays', $product->getBrand());
//        $this->assertEquals('lays.jpg', $product->getImage());
//    }
}