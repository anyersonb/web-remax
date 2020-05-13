<?php

$router = $di->getRouter();

$router->add('/:action', [
	'module' => "web",
	'controller' => 'index',
	'action' => 1,
])->setName("inicio");

foreach ($application->getModules() as $key => $module) {
	$namespace = preg_replace('/Module$/', 'Controllers', $module["className"]);

	$router->add('/' . $key . '/:params', [
		'namespace' => $namespace,
		'module' => $key,
		'controller' => 'index',
		'action' => 'index',
		'params' => 1
	])->setName($key);

	$router->add('/' . $key . '/:controller/:params', [
		'namespace' => $namespace,
		'module' => $key,
		'controller' => 1,
		'action' => 'index',
		'params' => 2
	])->setName("{$key}Controller");

	$router->add('/' . $key . '/:controller/:action/:params', [
		'namespace' => $namespace,
		'module' => $key,
		'controller' => 1,
		'action' => 2,
		'params' => 3
	])->setName("{$key}ControllerAction");

	$router->add('/' . $key . '/:controller/:int/:params', [
		'namespace' => $namespace,
		'module' => $key,
		'controller' => 1,
		'action' => "index",
		'id' => 2,
		'params' => 3
	])->setName("{$key}ControllerId");

	$router->add('/' . $key . '/:controller/:int/:action/:params', [
		'namespace' => $namespace,
		'module' => $key,
		'controller' => 1,
		'action' => 3,
		'id' => 2,
		'params' => 4
	])->setName("{$key}ControllerIdAction");

}
