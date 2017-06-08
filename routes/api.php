<?php

/*
|--------------------------------------------------------------------------
| API Routes > Dingo packages
|--------------------------------------------------------------------------
|
| To avoid complications with your main application routes this
| package utilizes its own router. As such we must first get
| an instance of the API router to create our endpoints.
|
*/

/*
 * APIs
 */

use Dingo\Api\Routing\Router;

$api = app(Dingo\Api\Routing\Router::class);

$params = [
    'version' => 'v1',
    'namespace' => 'App\\Api\\Controllers\\',
];

$api->group($params, function(Router $api) {

    $api->get('', ['as' => 'info', 'uses' => 'HomeController@info']);

    $api->post('user/auth', ['as' => 'user.auth', 'uses' => 'UserController@checkToken']);

    /*
     * Client
     */
    $api->group(['prefix' => 'client/{id}', 'as' => 'client'], function (Router $api) {

        $api->get('',          ['as' => 'info',      'uses' => 'ClientController@info']);
        $api->get('wishlists', ['as' => 'wishlists', 'uses' => 'ClientController@wishLists']);

    });

    /*
     * Admin
     */
    $api->group(['prefix' => 'stock', 'as' => 'stock'], function (Router $api) {

        $api->get('',                    ['as' => 'get', 'uses' => 'StockController@get']);
        $api->match(['post', 'put'], '', ['as' => 'store', 'uses' => 'StockController@store']);

    });
});
