<?php

$router->get('/', function(){
	return 'Hello World!';
});

$router->group([
	'prefix' => 'v1'
], 	function() use ($router) {

	$router->get('users', 'UserController@index');
	$router->get('user/{id}', 'UserController@show');
	$router->post('users', 'UserController@store');
	$router->put('user/{id}', 'UserController@update');
	$router->delete('user/{id}', 'UserController@destroy');

	// profile
	$router->post('profile', 'ProfileController@store');

});
