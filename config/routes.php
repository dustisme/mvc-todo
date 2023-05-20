<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	'/test' => 'test#index',
	'/' => 'application#index',
	'/viewTask/:id' => 'application#viewTask',
	'/editTask/:id' => 'application#editTask',
	'/updateTask/:id' => 'application#updateTask',
	'/addTask' => 'application#addTask',
	'/createTask' => 'application#createTask',
	'/createTask/:id' => 'application#createTask',
	'/deleteTask/:id' => 'application#deleteTask'
);
