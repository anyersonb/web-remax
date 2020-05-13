<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 
 [
			"accion" => "blog/",
			"titulo" => "Blog", 
		]
		
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

$config = new \Phalcon\Config([
	'version' => '1.0',

	'database' => [
		'adapter'  => 'Mysql',
		'host'	   => 'remaxdesignperu.com',
		'username' => 'remaxdes_remaxdesignperu',
		'password' => '5L0fpRv7R4Re+K%1XG',
		'dbname'   => 'easyanuncios',
		'charset'  => 'utf8',
	],

	"clave" => "r+&=tq%2MttMqEV5vzrQHpTJnfTduTup5MB7qAG3%Z03!Hb^-kk=+Amcr0q&R@J5",

	'application' => [
		'appDir'		 => APP_PATH . '/',
		'modelsDir' 	 => APP_PATH . '/common/models/',
		'pluginsDir'	 => APP_PATH . '/plugins/',
		'migrationsDir'  => APP_PATH . '/migrations/',
		"logDir"		 => BASE_PATH . "/log/",
		'cacheDir'		 => BASE_PATH . '/cache/',
		"viewsDir"		 => APP_PATH . "/common/views/",
		"helpersDir"	 => APP_PATH . "/common/helpers/",
		// "controllersDir" => APP_PATH . "/common/controllers/",

		// This allows the baseUri to be understand project paths that are not in the root directory
		// of the webpspace.  This will break if the public/index.php entry point is moved or
		// possibly if the web server rewrite rules are changed. This can also be set to a static path.
		'baseUri'		 => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
		//'baseUri'		 => "//" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["SCRIPT_NAME"]),
		//'staticBaseUri'	 => dirname($_SERVER["SCRIPT_NAME"]),
		// 'baseUri' => "/"
	],

	/**
	 * if true, then we print a new line at the end of each CLI execution
	 *
	 * If we dont print a new line,
	 * then the next command prompt will be placed directly on the left of the output
	 * and it is less readable.
	 *
	 * You can disable this behaviour if the output of your application needs to don't have a new line at end
	 */
	'printNewLine' => true,
	'imagen' => [
		"adapter" => "imagick"
	],
	"dominio" => $_SERVER["HTTP_HOST"],
	"dominioCDN" => $_SERVER["HTTP_HOST"],

	"correo" => [
		'driver' 	 => 'smtp',
		'host'	 	 => 'smtp.sendgrid.net',
		'port'	 	 => 465,
		'encryption' => 'ssl',
		'username'   => 'apikey',
		'password'	 => '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',
		'from'		 => [
			'email' => 'no-responder@easyanuncios.pe',
			'name'	=> 'Easy Anuncios Perú'
		]
	],

	"menuSuperior" => [
		[
			"accion" => "/",
			"titulo" => "Inicio",
		],[
			"accion" => "/#video",
			"titulo" => "¿Cómo funciona?",
		],[
			"accion" => "nosotros",
			"titulo" => "Nosotros",
		],[
			"accion" => "planes",
			"titulo" => "Planes",
		],
	],

	"paypal" => [
		"clientId" => "Afe2arPOCRD_tKGZuDZiaNVc75B8XYP7Sa0kbmbqYLzti97sSIhmdv2lPjNPd-CbRGnRwPENiucmr_GQ",
		"secret" => "EB_R8LTnCEy-EJrsOIFMKYr-oV_O3rge4di3sAVy375dKtvFDV_Jmv9Xs8nwU5WU86b-qxu8DXeTuGAS",
		"baseUrl" => "https://api.sandbox.paypal.com/v1/",
		"testMode" => true,
	],

	"facebook" => [
		"app_id" => "1292621670912785",
		//"ad_account_id" => "act_225099245022907",// "act_2403996669857818", act_225099245022907
		"app_secret" => "f3d3fbcd909410be57746e21c614bf5c",
		"ad_account_id" => "act_2403996669857818",
		"access_token" => "EAASXoeZBGExEBAEEslLg5KQZA2Byh8x7zZBXGVnaWUlZCYWpncOZC0vWoFIMAoux5j2DruunAqYKhfCanI0S5X3WK5pvVeyOSxXTeazZCMIRP6qW0HujeZBMEYq7cmYzXyTZCqr1dRxiQR1eynjRC8rjpkElv5XM6mNrU3CwYsw3w4cY2Sxdj9YNw74T2exqAlwZD",
		"business_id" => "168748697040238",
		"page_id" => "862074557506535",
		"app_token" => "1292621670912785|zSdMXw450L7A2szVSkJn2zNshic",
		"url" => "https://graph.facebook.com/v5.0/"
	]

]);

$ini = APP_PATH . '/config/config.ini';

if ( file_exists($ini) ) {
	$configIni= new Phalcon\Config\Adapter\Ini($ini);
	$config->merge($configIni);

}

$ini = BASE_PATH . '/config.ini';

if ( file_exists($ini) ) {
	$configIni= new Phalcon\Config\Adapter\Ini($ini);
	$config->merge($configIni);

}

return $config;
