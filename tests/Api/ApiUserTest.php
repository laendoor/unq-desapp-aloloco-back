<?php

namespace Tests\Api;

use App\Model\Client;
use App\Model\ShoppingList;
use Tests\Api\ApiTestCase;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class ApiUserTest
 * @package Api
 */
class ApiUserTest extends ApiTestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function it_auth_by_token()
    {
//        // Act
//        $response = $this->post(apiRoute('user.auth'), [
//            'token' => 'eyJhbGciOiJSUzI1NiIsImtpZCI6IjdjNGRhYWNiMzY5ZDY3NzYzZjcyMjIzYjA3NGQ0ZDEzN2JlNjhmYzgifQ.eyJhenAiOiI1OTAyOTU1MjA2ODctZ29wOGhxNDYzdjMwcDU4bjU5anQxbnFvYWh1a291Z3MuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhdWQiOiI1OTAyOTU1MjA2ODctZ29wOGhxNDYzdjMwcDU4bjU5anQxbnFvYWh1a291Z3MuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMTU1NTQyNDg2NDA3MDU4NzU0NzQiLCJlbWFpbCI6ImFsYW5tYXRrb3Jza2lAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF0X2hhc2giOiI2d3h2RTdhMDlfWVJic2JPdHlDc0l3IiwiaXNzIjoiYWNjb3VudHMuZ29vZ2xlLmNvbSIsImlhdCI6MTQ5Njc4OTc5NywiZXhwIjoxNDk2NzkzMzk3LCJuYW1lIjoiQWxhbiBNLiIsInBpY3R1cmUiOiJodHRwczovL2xoNC5nb29nbGV1c2VyY29udGVudC5jb20vLXVQVmZkWXdxSy13L0FBQUFBQUFBQUFJL0FBQUFBQUFBQVdZL0hybWRsQmlmLUhrL3M5Ni1jL3Bob3RvLmpwZyIsImdpdmVuX25hbWUiOiJBbGFuIiwiZmFtaWx5X25hbWUiOiJNLiIsImxvY2FsZSI6ImVzIn0.mSdRbv-Y0k969Bf2BnCBr6UBlOBkH_7yjDVR-vTGL2id2MwrcGkFCylmhKdiriVoOYbpCE08hCU3-wCAHTDPBpDaK1cOux6hAaSZjzlqb5GjTnZw5vDK40_SZjIFOTWygwb6Cc7gOqUfOKwfth1s2fCMNUw2QapxJXcMwLQiIJaIPBW2cT8zgFOVJBWfnmE-Bo1Y0P7GRx_Lde9hTMXA2V7OgDefg-Fw2idISRXgoqqMhGweikPx8pWwtmq_K6gvtW-OeCSi9HjeVl_W0iERzvxl4IIq9KtZbbwLkKnHuHRKaLyVNRU0rzYcyFtrR598kW7EMrz9SSqGsy77M_t7lw'
//        ]);
//
//        // Assert
//        $response->assertJson([
//            'auth' => 'ok',
//        ]);
    }
}
