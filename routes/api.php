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

    $api->get('client/{id}', ['as' => 'client', 'uses' => 'ClientController@info']);

    $api->get('products', ['as' => 'products', 'uses' => 'ProductsController@index']);
});
