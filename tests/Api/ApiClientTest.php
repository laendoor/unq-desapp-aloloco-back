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
        $response = $this->json('GET', apiRoute('client', ['id' => 1]));


        // Assert
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Jon',
            ]);
    }
}
