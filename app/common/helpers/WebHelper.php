<?php
use \Phalcon\DI\Injectable;
use Phalcon\Mvc\User\Plugin;

class WebHelper extends Plugin{
	public function esActivo(string $ruta): string
	{
		$url = $this->getDI()->get("url");
		$router = $this->getDI()->get("router");
		//return $this->url($ruta);
		//return ($url->get($ruta) == $router->getRewriteUri())?"activo":"";
		$esActivo = $url->get($ruta) == $router->getRewriteUri();
		$esActivo = $esActivo || $ruta==$router->getControllerName();
		return $esActivo?"activo":"";
	}

	public function url($ruta, string $dominio = null): string
	{

		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			$url = "https";
		else
			$url = "http";

		$url .= "://";

		//$url .= "desarrollo.easyanuncios.com";//$this->request->getServer("HTTP_HOST");
		$url .= $dominio?:$this->config->dominio;
		$url .= $this->url->get($ruta);
		//$this->request->getServer("HTTP_HOST")

		return $url;
	}
}
