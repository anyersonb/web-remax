<?php

use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

if( AMBIENTE == "desarrollo" )
{
	error_reporting(E_ALL);
}

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('FILES_PATH', BASE_PATH . '/files');

try {

	/**
	 * The FactoryDefault Dependency Injector automatically registers the services that
	 * provide a full stack framework. These default services can be overidden with custom ones.
	 */
	$di = new FactoryDefault();

	/**
	 * Include general services
	 */
	require APP_PATH . '/config/services.php';

	/**
	 * Include web environment specific services
	 */
	require APP_PATH . '/config/services_web.php';

	/**
	 * Get config service for use in inline setup below
	 */
	$config = $di->getConfig();
	/**
	 * Include Autoloader
	 */
	include APP_PATH . '/config/loader.php';


	/**
	 * Handle the request
	 */
	$application = new Application($di);
	/**
	 * Register application modules
	 */
	$application->registerModules([
		//'frontend' => ['className' => 'Easyanuncios\Modules\Frontend\Module'],
		'web'		=> ['className' => 'Easyanuncios\Modules\Web\Module'],
		'admin' 	=> ['className' => 'Easyanuncios\Modules\Admin\Module'],
		'system'	=> ['className' => 'Easyanuncios\Modules\System\Module'],
		'control'	=> ['className' => 'Easyanuncios\Modules\Control\Module'],
	]);

	/**
	 * Include routes
	 */
	require APP_PATH . '/config/routes.php';

	if( AMBIENTE == "desarrollo" )
	{

		print $application->handle()->getContent();
	}else{
		$resultado = $application->handle();
		$salida = $resultado->getContent();
		ob_start("ob_gzhandler");
		if ($resultado->getHeaders()->get("Content-Type") == "text/html" ) {
			//print str_replace(["\n", "\r", "\t", "  "], '', $salida);
			print preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$salida));
		}
		else{
			echo $salida;
		}
	}
} catch (\Exception $e) {
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
