<?php

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

// CdCollection routes
$router->get('/collections', 'CdCollectionController@index');
$router->get('/collections/{id}', 'CdCollectionController@show');
$router->put('/collections/{id}', 'CdCollectionController@update');
$router->post('/collections', 'CdCollectionController@store');
$router->delete('/collections/{id}', 'CdCollectionController@destroy');

$router->get('/rent', 'RentController@index');
$router->get('/rent/{id}', 'RentController@show');
$router->put('/rent/{id}', 'RentController@update');
$router->post('/rent', 'RentController@store');
$router->delete('/rent/{id}', 'RentController@destroy');

$router->put('/return/{id}', 'RentController@return');
