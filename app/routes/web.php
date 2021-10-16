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

$router->group(['prefix' => 'atletas'], function () use ($router) {
    $router->get('/{id}', 'AtletaController@read');
    $router->put('/{id}', 'AtletaController@update');
    $router->post('/', 'AtletaController@create');
    $router->delete('/{id}', 'AtletaController@delete');
});

$router->group(['prefix' => 'modalidades'], function () use ($router) {
    $router->get('/{id}', 'ModalidadeController@read');
    $router->put('/{id}', 'ModalidadeController@update');
    $router->post('/', 'ModalidadeController@create');
    $router->delete('/{id}', 'ModalidadeController@delete');
});

$router->group(['prefix' => 'atributos'], function () use ($router) {
    $router->get('/{id}', 'AtributoController@read');
    $router->put('/{id}', 'AtributoController@update');
    $router->post('/', 'AtributoController@create');
    $router->delete('/{id}', 'AtributoController@delete');
});

$router->group(['prefix' => 'notas'], function () use ($router) {
    $router->get('/{id}', 'NotaController@read');
    $router->put('/{id}', 'NotaController@update');
    $router->post('/', 'NotaController@create');
    $router->delete('/{id}', 'NotaController@delete');
});
