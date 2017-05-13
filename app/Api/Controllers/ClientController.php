<?php
namespace App\Api\Controllers;

use Dingo\Api\Http\Response;

/**
 * Class ClientController
 * @package App\Api\Controllers
 *
 * @Resource("Client", uri="/client")
 */
class ClientController extends ApiBaseController
{
    /**
     * Show client logged information
     *
     * @Get("/")
     *
     * @return Response
     */
    public function info(): Response {
        return $this->response->array(['name' => 'Jon']);
    }

    /**
     * Show client wish lists
     *
     * @Get("/wishlists")
     *
     * @return Response
     */
    public function wishLists(): Response {
        return $this->response->array([
            'error' => '400',
            'description' => 'TODO'
        ]);
    }
}