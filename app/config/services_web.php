<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;

use Phalcon\Logger\Factory as Logger;

use Phalcon\Cache\Frontend\Factory as FFactory;
use Phalcon\Cache\Backend\Factory as BFactory;

/**
 * Registering a router
 */
$di->setShared('router', function () {
	$router = new Router();

	$router->setDefaultModule('web');

	return $router;
});

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->setShared('url', function () {
	$config = $this->getConfig();

	$url = new UrlResolver();
	$url->setBaseUri($config->application->baseUri);
	//$url->setStaticBaseUri($config->application->staticBaseUri);

	return $url;
});

/**
 * Starts the session the first time some component requests the session service
 */
$di->setShared('session', function () {
	$session = new SessionAdapter();
	$session->start();

	return $session;
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
	return new Flash([
		'error'   => 'mensaje error',
		'success' => 'mensaje ok',
		'notice'  => 'mensaje info',
		'warning' => 'mensaje peligro'
	]);
});
$di->set('flashsession', function () {
	return new FlashSession([
		'error'   => 'mensaje error',
		'success' => 'mensaje ok',
		'notice'  => 'mensaje info',
		'warning' => 'mensaje peligro'
	]);
});

/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function () use ($di) {
	$eventsManager = $di->getShared('eventsManager');

	$dispatcher = new Dispatcher();
	$dispatcher->setEventsManager($eventsManager);
	$dispatcher->setDefaultNamespace('Easyanuncios\Modules\Web\Controllers');
	return $dispatcher;
});


$di->setShared('view', function () {
	$config = $this->getConfig();

	$view = new View();
	$view->setViewsDir($config->get('application')->viewsDir);

	$view->registerEngines([
		'.phtml' => PhpEngine::class
	]);

	return $view;
});

$di->setShared('logger', function () {
	$options = [
		'name'    => 'php.log',
		'adapter' => 'file',
	];

	$logger = Logger::load($options);

	return $logger;
});


$di->setShared('cache', function () {
	$config = $this->getConfig();
	$options = [
		'lifetime' => 172800,
		'adapter'  => 'none',
	];
	$frontendCache = FFactory::load($options);


	$options = [
		'cacheDir' => $config->application->cacheDir,
		'prefix'   => 'ea-',
		'frontend' => $frontendCache,
		'adapter'  => 'file',
	];

	$backendCache = BFactory::load($options);

	return $backendCache;
});



$helpers = glob("{$di->getConfig()->application->helpersDir}*Helper.php");
foreach ($helpers as $helper) {
	// var_dump(basename($helper, ".php"));
	$helperClass = basename($helper, ".php");
	$di->setShared (lcfirst($helperClass), function () use ($helperClass, $di) {
		$helper = new $helperClass();
		$helper->setDi ($di);

		return $helper;
	});
}
