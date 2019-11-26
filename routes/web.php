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

$router->get('/', ['uses' => 'DomainsController@show','as' => 'main']);
$router->post('domains', 'DomainsController@store');
$router->get('domains/{id}', 'DomainsTableController@index');
