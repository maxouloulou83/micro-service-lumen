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

$router->get('/message', 'MessageController@index');
$router->get('/message/{id}', 'MessageController@show');
$router->post('/message', 'MessageController@create');
$router->put('/message{id}', 'MessageController@update');
$router->delete('/message{id}', 'MessageController@delete');

$router->group(['prefix' => '/api'], function () use ($router) {
    $router->get('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');

    $router->group(['middleware' => 'auth'], function() use ($router) {
        $router->post('/logout', 'AuthController@logout');
        $router->get('/refresh', 'AuthController@refresh');
        $router->post('/refresh', 'AuthController@refresh');
    });
});

