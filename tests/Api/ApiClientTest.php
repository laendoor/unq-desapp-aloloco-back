<?php

namespace Tests\Api;

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
        // Act
        $response = $this->get(apiRoute('client.info', ['id' => 0]));

        // Assert
        $response->assertJson([
            'name' => 'Jon',
        ]);
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
}
