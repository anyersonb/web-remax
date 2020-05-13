<?php

namespace Easyanuncios\Modules\System\Controllers;

class UtilController extends ControllerBase
{

	public function indexAction()
	{
		$this->response->setContentType( "text/plain" );

	}

	public function configAction()
	{
		$this->response->setContentType( "text/plain" );
		$this->response->setContent( print_r($this->config->toArray(), true));
		return $this->response;
	}

	public function infoAction()
	{
		//$this->response->setContentType( "text/plain" );
		phpinfo();
		return;
	}

	public function diAction()
	{
		$salida = [];
		foreach ($this->di->getServices() as $clave => $valor) {
			$salida[$clave] = $valor->isShared()?:"privado";
		}

		$this->response->setContent( print_r($salida, true));
		return $this->response->send();
	}

	public function datosAction()
	{
		$salida = [];
		$salida["get_current_user"] = get_current_user();
		$salida["user"] = shell_exec( 'whoami' );

		$this->response->setContent( print_r($salida, true));
		return $this->response->send();
	}

	public function erroresAction()
	{
		$errorPath = ini_get('error_log');
		$log = file_get_contents($errorPath);
		$this->response->setContent( $log );
		return $this->response->send();
	}

	public function iniAction()
	{
		$salida = ini_get_all();
		$this->response->setContent( print_r($salida, true) );
		return $this->response->send();
	}

	public function hashAction($t){
		echo hash( "sha256", $t );
		echo PHP_EOL;
		echo $t;
	}

	public function echoAction($titulo = "")
	{
		echo $titulo . PHP_EOL;
		echo str_repeat("=", 80) . PHP_EOL . PHP_EOL;

		echo "GET" . PHP_EOL;
		print_r($this->request->getQuery());
		echo str_repeat("-", 80) . PHP_EOL . PHP_EOL;
		echo "POST" . PHP_EOL;
		print_r($this->request->getPost());
		echo str_repeat("-", 80) . PHP_EOL . PHP_EOL;
		echo "PUT" . PHP_EOL;
		print_r($this->request->getPut());
		echo str_repeat("-", 80) . PHP_EOL . PHP_EOL;

		echo "REQUEST" . PHP_EOL;
		print_r($this->request->get());
		echo str_repeat("-", 80) . PHP_EOL . PHP_EOL;

		echo "SERVER " . PHP_EOL;
		print_r($_SERVER);
		echo str_repeat("-", 80) . PHP_EOL . PHP_EOL;
	}
}
