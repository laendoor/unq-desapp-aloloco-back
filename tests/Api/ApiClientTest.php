<?php

namespace Tests\Api;

use App\Model\User;
use App\Model\Client;
use App\Model\ShoppingList;

/**
 * Class ApiClientTest
 * @package Api
 */
class ApiClientTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_get_client_info()
    {
        // Arrange
        $jon = entity(User::class)->create();

        // Act
        $response = $this->get(apiRoute('client.info', ['id' => $jon->getId()]));

        // Assert
        $response->assertJsonFragment(['email' => $jon->getEmail()]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_get_client_wish_lists()
    {
        // Arrange
        $jon  = entity(Client::class)->create();
        $list = entity(ShoppingList::class, 'wish-list')->create([
            'client' => $jon
        ]);

        // Act
        $response = $this->get(apiRoute('client.wishlists', ['id' => 0]));

        // Assert
        $response->assertJsonFragment([
            'id' => $list->getId()
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_get_client_shopping_history()
    {
        // Arrange
        $arya = entity(Client::class)->create(['email' => 'nobody@nowhere']);
        $list = entity(ShoppingList::class, 'wish-list')->create([
            'client' => $arya,
            'name'   => 'Offers to Many-Faced God'
        ]);
        $list->markAsPurchased();

        // Act
        $response = $this->get(apiRoute('client.history', ['id' => $arya->getId()]));

        // Assert
        $response->assertJsonFragment(['email' => 'nobody@nowhere']);
        $response->assertJsonFragment(['name'  => 'Offers to Many-Faced God']);
    }
}
