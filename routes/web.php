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

$router->group(['prefix' => 'auth'], function () use ($router){
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

$router->group(['prefix' => 'buildings'], function () use ($router){
    $router->get('/allbuild', 'BuildingController@all');
    $router->post('/addbuild', 'BuildingController@add');
    $router->get('/showbuild/{id}', 'BuildingController@show');
    $router->put('/updatebuild/{id}', 'BuildingController@update');
    $router->delete('/deletebuild/{id}', 'BuildingController@delete');
});

$router->group(['prefix' => 'customers'], function () use ($router){
    $router->get('/all', 'CustomerController@all');
    $router->get('/showcustid/{id}', 'CustomerController@showcustid');
    $router->get('/showcustcity/{city}', 'CustomerController@showcustcity');
    $router->get('/showcustcat/{cat}', 'CustomerController@showcustcat');
});

$router->group(['prefix' => 'orders'], function () use ($router){
    $router->get('/allorders', 'OrderController@allorders');
    $router->post('/addorders/{id}', 'OrderController@addorders');
});

$router->get('/all', 'ViewController@all');
