<?php

namespace App\Api\Controllers;

/**
 * Class ClientController
 * @package App\Api\Controllers
 */
class ClientController extends ApiBaseController
{
    public function info() {
        return $this->response->array(['name' => 'Jon']);
    }
}