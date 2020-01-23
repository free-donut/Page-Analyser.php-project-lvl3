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

$router->get('/', ['uses' => 'DomainController@main','as' => 'domains.main']);
$router->get('domains', ['uses' => 'DomainController@index', 'as' => 'domains.index']);
$router->post('domains', ['uses' => 'DomainController@store', 'as' => 'domains.store']);
$router->get('domains/{id}', ['uses' => 'DomainController@show', 'as' => 'domains.show']);
