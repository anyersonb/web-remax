<?php

use Phalcon\Loader;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\Model\MetaData\Strategy\Annotations as StrategyAnnotations;

use Phalcon\Crypt;
use Phalcon\Security;

use Phalcon\Ext\Mailer\Manager as Mailer;

use Phalcon\Cache\Frontend\Data as FrontendData;
use Phalcon\Cache\Backend\File  as BackendFile;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
	return include APP_PATH . "/config/config.php";
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
	$config = $this->getConfig();

	$class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
	$params = [
		'host'	   => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname'   => $config->database->dbname,
		'charset'  => $config->database->charset
	];

	if ($config->database->adapter == 'Postgresql') {
		unset($params['charset']);
	}

	$connection = new $class($params);

	return $connection;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
	$metadata =  new MetaDataAdapter();
	// $metadata->setStrategy(
	// 	new StrategyAnnotations()
	// );
	return $metadata;
});

$di->set(
    'modelsCache',
    function () {
		// Cache data for one day (default setting)
		$config = $this->getConfig();
        $frontCache = new FrontendData(
            [
                'lifetime' => 86400,
            ]
        );

        // Memcached connection settings
        $cache = new BackendFile(
            $frontCache,
            [
                'cacheDir' => $config->application->cacheDir,
				'prefix'   => 'ea-',
            ]
        );

        return $cache;
    }
);


/**
 * Configure the Volt service for rendering .volt templates
 */
$di->setShared('voltShared', function ($view) {
	$config = $this->getConfig();

	$volt = new VoltEngine($view, $this);
	$volt->setOptions([
		'compiledPath' => function ($templatePath) use ($config) {
			$basePath = $config->application->appDir;
			if ($basePath && substr($basePath, 0, 2) == '..') {
				$basePath = dirname(__DIR__);
			}

			$basePath = realpath($basePath);
			$templatePath = trim(substr($templatePath, strlen($basePath)), '\\/');

			$filename = basename(str_replace(['\\', '/'], '_', $templatePath), '.volt') . '.php';

			$cacheDir = $config->application->cacheDir;
			if ($cacheDir && substr($cacheDir, 0, 2) == '..') {
				$cacheDir = __DIR__ . DIRECTORY_SEPARATOR . $cacheDir;
			}

			$cacheDir = realpath($cacheDir);

			if (!$cacheDir) {
				$cacheDir = sys_get_temp_dir();
			}

			if (!is_dir($cacheDir . DIRECTORY_SEPARATOR . 'volt')) {
				@mkdir($cacheDir . DIRECTORY_SEPARATOR . 'volt', 0755, true);
			}

			return $cacheDir . DIRECTORY_SEPARATOR . 'volt' . DIRECTORY_SEPARATOR . $filename;
		}
	]);

	return $volt;
});


$di->setShared(
	'crypt',
	function () {
		$config = $this->getConfig();
		$crypt = new Crypt();

		$crypt->setKey( $config->clave );
		$crypt->setPadding ( Crypt::PADDING_ISO_IEC_7816_4 );
		$crypt->setCipher( 'bf-cbc' );
		$crypt->setHashAlgo( 'sha256' );
		$crypt->useSigning ( true );

		return $crypt;
	}
);

$di->setShared(
	'seguridad',
	function () {
		$security = new Security();
		$security->setWorkFactor(13);
		return $security;
	}
);

$di->setShared(
	'mailer',
	function () {
		$config = $this->getConfig();
		$mailer = new Mailer((array)$config->correo);

		return $mailer;
	}
);
