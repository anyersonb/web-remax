<?php
namespace Easyanuncios\Modules\Admin;

use Phalcon\Config;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Easyanuncios\Modules\Admin\Plugins\SeguridadPlugin;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;


class Module implements ModuleDefinitionInterface
{
	/**
	 * Registers an autoloader related to the module
	 *
	 * @param DiInterface $di
	 */
	public function registerAutoloaders(DiInterface $di = null)
	{
		$loader = new Loader();

		$loader->registerNamespaces([
			'Easyanuncios\Modules\Admin\Controllers' => __DIR__ . '/controllers/',
			'Easyanuncios\Modules\Admin\Models' 	 => __DIR__ . '/models/',
			'Easyanuncios\Modules\Admin\Forms' 		 => __DIR__ . '/forms/',
			'Easyanuncios\Modules\Admin\Plugins' 	 => __DIR__ . '/plugins/',
		]);



		$loader->register();
	}

	/**
	 * Registers services related to the module
	 *
	 * @param DiInterface $di
	 */
	public function registerServices(DiInterface $di)
	{
		/**
		 * Try to load local configuration
		 */
		if (file_exists(__DIR__ . '/config/config.php')) {

			$config = $di['config'];

			$override = new Config(include __DIR__ . '/config/config.php');

			if ($config instanceof Config) {
				$config->merge($override);
			} else {
				$config = $override;
			}
		}

		/**
		 * Setting up the view component
		 */
		$di['view'] = function () {
			$config = $this->getConfig();

			$view = new View();
			$view->setDI($this);
			$view->setViewsDir($config->get('application')->viewsDir);
			$view->setPartialsDir($config->get('application')->viewsDir."partials/");

			$view->registerEngines([
				'.volt'  => 'voltShared',
				'.phtml' => PhpEngine::class
			]);

			return $view;
		};

		/**
		 * Database connection is created based in the parameters defined in the configuration file
		 */
		$di['db'] = function () {
			$config = $this->getConfig();

			$dbConfig = $config->database->toArray();

			$dbAdapter = '\Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
			unset($config['adapter']);

			return new $dbAdapter($dbConfig);
		};

		// Seguridad
		$seguridad = new SeguridadPlugin();
		$di['eventsManager']->attach('dispatch', $seguridad);
	}
}
