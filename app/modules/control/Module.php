<?php
namespace Easyanuncios\Modules\Control;

use Phalcon\Config;
use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Easyanuncios\Modules\Control\Plugins\SeguridadPlugin;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;

use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;

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
			'Easyanuncios\Modules\Control\Controllers' => __DIR__ . '/controllers/',
			'Easyanuncios\Modules\Control\Models' => __DIR__ . '/models/',
			'Easyanuncios\Modules\Control\Forms' 		 => __DIR__ . '/forms/',
			'Easyanuncios\Modules\Control\Plugins' 	 => __DIR__ . '/plugins/',
			'Easyanuncios\Modules\Control\Tags' 	 => __DIR__ . '/tags/',
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
		$di->set('view', function () {
			$config = $this->getConfig();

			$view = new View();
			//$view->setDI($this);
			$view->setViewsDir(__DIR__ . '/views/');
			$view->setPartialsDir(__DIR__ . '/views/partials/');
			//$view->setViewsDir($config->get('application')->viewsDir);

			$view->registerEngines([
				'.volt'  => 'voltShared',
				'.phtml' => PhpEngine::class
			]);

			return $view;
		});

		$di->set('controlTags', function () {
			return new Tags\ControlTags();
		});

		$di->set('flash', function () {
			return new Flash([
				'error'   => 'notification is-danger',
				'success' => 'notification is-success',
				'notice'  => 'notification is-info',
				'warning' => 'notification is-warning'
			]);
		});

		$di->set('flashsession', function () {
			return new FlashSession([
				'error'   => 'notification is-danger',
				'success' => 'notification is-success',
				'notice'  => 'notification is-info',
				'warning' => 'notification is-warning'
			]);
		});

		// Seguridad
		$seguridad = new SeguridadPlugin();
		$di['eventsManager']->attach('dispatch', $seguridad);

	}
}
