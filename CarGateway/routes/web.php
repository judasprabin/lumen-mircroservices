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
    return "API Gateway for mircorservices build on " . $router->app->version();
});

//key generator
$router->get('/key', function () {
    return \Illuminate\Support\Str::random(32);
});


$router->group(['middleware' => 'client.credentials'], function () use ($router) {

    /**
     * Users endpoints
     */
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/{id}', 'UserController@show');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@delete');

    /**
     * Owners endpoints
     */
    $router->get('/owners', 'OwnerController@index');
    $router->post('/owners', 'OwnerController@store');
    $router->get('/owners/{id}', 'OwnerController@show');
    $router->put('/owners/{id}', 'OwnerController@update');
    $router->delete('/owners/{id}', 'OwnerController@delete');

    /**
     * Cars endpoints
     */
    $router->get('/cars', 'CarController@index');
    $router->post('/cars', 'CarController@store');
    $router->get('/cars/{id}', 'CarController@show');
    $router->put('/cars/{id}', 'CarController@update');
    $router->delete('/cars/{id}', 'CarController@delete');

});

/**
 * User credntials protected routes
 */

// $router->group(['middleware' => 'auth:api'], function () use ($router) {
//     $router->get('/users/me', 'UserController@me');
// });