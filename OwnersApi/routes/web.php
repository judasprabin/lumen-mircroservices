<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//key generator
$router->get('/key', function () {
    return \Illuminate\Support\Str::random(32);
});

// cache clear



// 
$router->get('/owners', 'OwnerController@index');
$router->post('/owners', 'OwnerController@store');
$router->get('/owners/{id}', 'OwnerController@show');
$router->put('/owners/{id}', 'OwnerController@update');
$router->delete('/owners/{id}', 'OwnerController@delete');
