<?php

namespace Api;

use Tests\Api\ApiTestCase;

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
        $response = $this->get(apiRoute('client.info'));

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
        // TODO make a list

        // Act
        $response = $this->get(apiRoute('client.wishlists'));

        // Assert
        $response->assertJson([
            'data' => []
        ]);
    }
}
