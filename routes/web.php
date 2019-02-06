<?php

$router->get('/', function(){
	return 'Hello World!';
});

$router->group([
	'prefix' => 'v1'
], 	function() use ($router) {

	$router->get('users', 'UserController@index');
	$router->post('users', 'UserController@store');
	$router->put('users', 'UserController@update');
	$router->delete('users', 'UserController@destroy');

});
