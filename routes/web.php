<?php

$router->get('/', function(){
	return 'Hello World!';
});

$router->group(['prefix' => 'v1'], function() use ($router) {
	# user
	$router->get('users', 'UserController@index');
	$router->get('users/{uuid}', 'UserController@show');
	// $router->post('users', 'UserController@store');
	// $router->put('user/{uuid}', 'UserController@update');
	// $router->delete('user/{uuid}', 'UserController@destroy');

	# profile
	$router->get('users/{uuid}/profile', 'ProfileController@show');
	// $router->post('users/{uuid}/profile', 'ProfileController@store');

});
