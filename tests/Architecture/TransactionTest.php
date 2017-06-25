<?php
namespace Tests\Integrations;

use App\Model\Product;
use App\Model\Price;
use App\Repository\PriceRepository;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Tests\DatabaseTestCase;

class TransactionTest extends DatabaseTestCase
{
    /**
     * @test
     *
     * Product's table requiere most of fields _not nulls_, `name` for example
     * This rest create & persists a good Price an then
     * create & persists a bad Products.
     *
     * Transaction should fails & both object should not be persisted on database.
     *
     * @return void
     */
    public function it_verify_that_transaction_is_well_aborted_when_exceptions_occurs(): void
    {
        // Arrange
        $repo = resolve(ProductRepository::class);
        $price   = new Price(44, 50);
        $product = new Product('Product', 'Lays', $price, 10);

        // Act
        try {
            $repo->trySaveWithErrors($product);
        } catch (NotNullConstraintViolationException $e) {
            // Assert
            $products = $repo->findAll();
            $repo = resolve(PriceRepository::class);
            $prices = $repo->findAll();


            $this->assertEmpty($products);
            $this->assertEmpty($prices);
            $this->assertDatabaseMissing('products', ['name' => 'Product']);
            $this->assertDatabaseMissing('prices', ['value' => 44]);
        }
    }

}