<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
	'Easyanuncios\Models' => APP_PATH . '/common/models/',
	'Easyanuncios\Models\Behaviors' => APP_PATH . '/common/models/behaviors/',
	'Easyanuncios'		  => APP_PATH . '/common/library/',
	'Easyanuncios\Plugins' => APP_PATH . '/plugins/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
	'Easyanuncios\Modules\Cli\Module'	=> APP_PATH . '/modules/cli/Module.php',
	'Easyanuncios\Modules\Web\Module'	=> APP_PATH . '/modules/web/Module.php',
	'Easyanuncios\Modules\Admin\Module'   => APP_PATH . '/modules/admin/Module.php',
	'Easyanuncios\Modules\System\Module'	=> APP_PATH . '/modules/system/Module.php',
	'Easyanuncios\Modules\Control\Module'	=> APP_PATH . '/modules/control/Module.php',
]);

$loader->registerDirs([
	APP_PATH . '/common/helpers/',
]);

$loader->register();
