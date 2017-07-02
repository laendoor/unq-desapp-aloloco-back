<?php

namespace Tests\Api;

use App\Model\User;
use App\Model\Product;
use App\Model\ShoppingList;
use App\Model\WishedProduct;
use App\Model\Product\StockedProduct;
use App\Repository\ShoppingListRepository;
use App\Repository\StockedProductRepository;
use Illuminate\Http\UploadedFile;

/**
 * Class ApiStockTest
 * @package Api
 */
class ApiStockTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_get_all_products()
    {
        // Arrange
        entity(Product::class)->create([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'image' => 'lays.jpg',
            'stock' => 10,
        ]);

        // Act
        $response = $this->get(apiRoute('stock.get'));

        // Assert
        $response->assertJsonFragment([
            'name'  => 'Papas Fritas',
            'brand' => 'Lays',
            'image' => 'lays.jpg',
            'stock' => 10
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_store_stock_from_csv_file(): void {
        // Arrange
        $path = base_path('doc/Productos.csv');
        $name = 'Productos.csv';
        $file = new UploadedFile($path, $name, filesize($path), 'text/csv', null, true);

        // Act
        $response = $this->put(apiRoute('stock.store'), [
            'file' => $file
        ]);

        // Assert
        $response->assertJson([
            'store' => true,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Bizcochos',
            'brand' => 'Don Satur',
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_get_products_related_of_some_product()
    {
        // Arrange
        $sword = entity(Product::class)->create(['name' => 'Espada']);
        $fire  = entity(Product::class)->create(['name' => 'Fuego']);
        $ice   = entity(Product::class)->create(['name' => 'Hielo']);

        $jon  = entity(User::class)->create(['username' => 'jon.snow']);
        $dany = entity(User::class)->create(['username' => 'daenerys']);

        $jonList  = entity(ShoppingList::class, 'wish-list')->make(['user' => $jon]);
        $danyList = entity(ShoppingList::class, 'wish-list')->make(['user' => $dany]);

        $this->addTo($danyList,  $ice, 1);
        $this->addTo($danyList, $fire, 1);
        $this->addTo($jonList, $sword, 1);

        // Act
        $related = $this->api->get("products/{$ice->getId()}/related");

        // Assert
        $this->assertEquals(1, $related->count());
        $this->assertEquals($fire->getName(), $related->first()->getName());
    }

    /*
     * Internals
     */

    protected function addTo(ShoppingList $list, Product $product, $quantity)
    {
        $repo = resolve(ShoppingListRepository::class);
        $list->addProduct(new WishedProduct($product, $quantity));
        $repo->save($list);
    }
}
