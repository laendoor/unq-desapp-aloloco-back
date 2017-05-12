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
        $response = $this->get(apiRoute('client', ['id' => 1]));

        // Assert
        $response->assertJson([
            'name' => 'Jon',
        ]);
    }
}
