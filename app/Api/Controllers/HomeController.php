<?php

namespace App\Api\Controllers;

/**
 * Class HomeController
 * @package App\Api\Controllers
 */
class HomeController extends ApiBaseController
{
    public function info() {
        return $this->response->array([
            'api' => 'aLoLoco'
        ]);
    }
}