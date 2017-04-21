<?php

namespace Api;

use Tests\Api\ApiTestCase;

/**
 * Class ClientApiTest
 * @package Api
 */
class ClientApiTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_get_client_info()
    {
        // Act
        $response = $this->json('GET', '/api/client/1');

        // Assert
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Jon',
            ]);
    }
}
