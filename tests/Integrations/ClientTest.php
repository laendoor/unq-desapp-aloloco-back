<?php
namespace Tests\Integrations;

use App\Model\Client;
use Tests\Builders\ProductBuilder;
use Tests\Builders\ShoppingListBuilder;
use Tests\Builders\UserBuilder;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;

class ClientTest extends IntegrationsTestCase
{
    /**
     * @var ObjectRepository
     */
    private $repo;

    protected function setUp()
    {
        parent::setUp();

        $this->repo = EntityManager::getRepository(Client::class);
    }

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

        // Act
        EntityManager::persist($dany);
        EntityManager::flush();
        $dany_db = collect($this->repo->findAll())->first();

        // Assert
        $this->assertEquals(1, $dany_db->getId());
        $this->assertEquals('mother.of.dragons@seven-kingdoms.org', $dany_db->getEmail());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_map_a_client_with_a_basic_shopping_list(): void
    {
        // Arrange
        $list = ShoppingListBuilder::new()->withName('Kingdoms to Conquer')->build();
        $dany = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        EntityManager::persist($dany);
        EntityManager::flush();
        $dany_db = collect($this->repo->findAll())->first();

        // Assert
        $this->assertEquals(1, $dany_db->getShoppingLists()->count());
        $this->assertEquals('Kingdoms to Conquer', $dany_db->getShoppingLists()->first()->getName());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_map_a_client_with_a_shopping_list_with_products(): void
    {
        // Arrange
        $milk = ProductBuilder::new()
            ->withName('Leche')
            ->withBrand('La Serenísima')
            ->withImage('milk.jpg')
            ->withQuantity(2)
            ->buildWished();
        $list = ShoppingListBuilder::new()->withName('Kingdoms to Conquer')->build();
        $list->addWishedProduct($milk);
        $dany = UserBuilder::newWithMocks()->withShoppingList($list)->buildClient();

        // Act
        EntityManager::persist($dany);
        EntityManager::flush();

        $dany_db = collect($this->repo->findAll())->first();

        // Assert
        $list_db = $dany_db->getShoppingLists()->first()->getWishedProducts();
        $this->assertEquals(1, $list_db->count());
        $this->assertContains('Leche', $list_db->first()->getName());
    }
}