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
$router->group(["prefix" => "api/favoritos","middleware" => "secret"], function () use ($router) {
	$router->get("", "FavoritoController@index");
	$router->get("/{idUsuario}", "FavoritoController@showAll");

	$router->post("", "FavoritoController@store");
	$router->delete("","FavoritoController@destroyParams");
	$router->delete("/{id}", "FavoritoController@destroy");
});
