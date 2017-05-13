<?php
namespace App\Api\Controllers;

use Dingo\Api\Http\Response;

/**
 * Class HomeController
 * @package App\Api\Controllers
 *
 * @Resource("Home", uri="/")
 */
class HomeController extends ApiBaseController
{
    /**
     * Show API info
     *
     * @Get("/")
     *
     * @return Response
     */
    public function info(): Response {
        return $this->response->array([
            'api' => 'aLoLoco'
        ]);
    }
}