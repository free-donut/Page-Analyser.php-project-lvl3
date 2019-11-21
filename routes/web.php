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

Route::get('/', function () {
    return view('main');
});

//Route::get('/', 'DomainsController@store');

$router->get('foo', function () {
    return 'Hello World';
});

$router->post('foo', function () {
    //
});

$router->get('user/{id}', 'UserController@show');

$router->get('home', function () {
    return response($content, $status)
                  ->header('Content-Type', $value);
});

Route::get('navbar', function () {
    return view('navbar', ['name' => 'Zhopa']);
});

$router->post('domains', 'DomainsController@store');

$router->get('domains/{id}', 'DomainsTableController@index');
