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
    $router->get('/all', 'BuildingController@all');
    $router->post('/add', 'BuildingController@add');
    $router->get('/show/{id}', 'BuildingController@show');
    $router->put('/update/{id}', 'BuildingController@update');
    $router->delete('/delete/{id}', 'BuildingController@delete');
});


$router->group(['prefix' => 'customers'], function () use ($router){
    $router->get('/all', 'CustomerController@all');
    $router->post('/add', 'CustomerController@add');
    $router->get('/show/{id}', 'CustomerController@showid');
    $router->post('/show/{loc}', 'CustomerController@showloc');
    $router->post('/show/{cat}', 'CustomerController@showcat');
});

$router->get('/all', 'ViewController@all');
