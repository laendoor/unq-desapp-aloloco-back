<?php

use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// No web routes :: only API
Route::get('/routes', function () {

    $middlewareClosure = function ($middleware) {
        return $middleware instanceof Closure ? 'Closure' : $middleware;
    };

    return new Response(view('pretty-routes::routes', [
        'routes' => Route::getRoutes(),
        'middlewareClosure' => $middlewareClosure,
    ]));
});
