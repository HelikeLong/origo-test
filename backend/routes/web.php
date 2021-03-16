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

$router->group(['prefix' => '/api', 'as' => 'api.'], function () use ($router) {
    $router->post('/auth/login', 'AuthController@login');

    $router->group(['prefix' => '/auth', 'as' => 'auth.', 'middleware' => 'auth'], function () use ($router) {
        $router->post('/logout', 'AuthController@logout');
    });

    $router->group(['prefix' => '/clients', 'as' => 'clients.', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', 'ClientController@all');
        $router->post('/', 'ClientController@store');
        $router->get('/{id}', 'ClientController@get');
        $router->put('/{id}', 'ClientController@update');
        $router->delete('/{id}', 'ClientController@delete');
    });

    $router->group(['prefix' => '/plans', 'as' => 'plans.', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', 'PlanController@all');
    });
});
