<?php
namespace Easyanuncios\Modules\System\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
	public function onConstruct()
	{
		$this->view->disable();
		$this->response->setContentType( "text/plain" );
		$this->response->setHeader('Access-Control-Allow-Origin', '*');
		$this->response->setHeader("Access-Control-Allow-Methods", "POST, GET");
		$this->response->setHeader('Access-Control-Allow-Headers', "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	}

	public function __call($nombre, $args)
	{
		echo get_class($this), "\\", $nombre, PHP_EOL;
		if ( count( $args )) {
			print_r($args);
		}
	}

}
