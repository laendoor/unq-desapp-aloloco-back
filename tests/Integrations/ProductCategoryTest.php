<?php
namespace Tests\Integrations;

use App\Model\ProductCategory;
use App\Repository\ProductCategoryRepository;

class ProductCategoryTest extends IntegrationsTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->repo = resolve(ProductCategoryRepository::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_stores_and_retrieves()
    {
        // Arrange
        $category = entity(ProductCategory::class)->create(['name' => 'Vino']);

        // Assert
        $this->assertEquals(1, $category->getId());
        $this->assertEquals('Vino', $category->getName());
        $this->assertEquals('vino', $category->getSlug());
        $this->assertEquals(ProductCategory::class . "(1,vino)", $category->__toString());
    }
}