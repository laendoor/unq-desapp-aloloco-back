<?php
namespace Api;

use Tests\Api\ApiTestCase;

/**
 * Class ApiHomeTest
 * @package Api
 */
class ApiHomeTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_get_api_info()
    {
        // Act
        $response = $this->get(apiRoute('info'));

        // Assert
        $response->assertJson([
            'api' => 'aLoLoco',
        ]);
    }
}
