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

    /*
     * User
     */
    $api->group(['prefix' => 'user', 'as' => 'user'], function (Router $api) {

        $api->post('auth',          ['as' => 'auth',      'uses' => 'UserController@checkToken']);
        $api->get('{id}',           ['as' => 'info',      'uses' => 'UserController@info']);
        $api->get('{id}/wishlists', ['as' => 'wishlists', 'uses' => 'UserController@wishLists']);
        $api->get('{id}/history',   ['as' => 'history',   'uses' => 'UserController@shoppingHistory']);
        $api->get('{id}/shopping-list/{listId}/box', ['as' => 'get-box', 'uses' => 'UserController@getBox']);

    });

    /*
     * Products
     */
    $api->group(['prefix' => 'products', 'as' => 'products'], function (Router $api) {

        $api->get('{id}/related', ['as' => 'related', 'uses' => 'ProductsController@related']);

        /*
         * Categories
         */
        $api->group(['prefix' => 'categories', 'as' => 'categories'], function (Router $api) {

            $api->get('',        ['as' => 'all',          'uses' => 'ProductCategoriesController@index']);
            $api->get('offers',  ['as' => 'offers.all',   'uses' => 'ProductCategoriesController@offers']);
            $api->post('offers', ['as' => 'offers.store', 'uses' => 'ProductCategoriesController@storeOffer']);

        });
    });

    /*
     * Admin
     */
    $api->group(['prefix' => 'stock', 'as' => 'stock'], function (Router $api) {

        $api->get('',                    ['as' => 'get', 'uses' => 'StockController@get']);
        $api->match(['post', 'put'], '', ['as' => 'store', 'uses' => 'StockController@store']);

    });
});
