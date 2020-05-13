<?php
namespace Easyanuncios\Modules\Web\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

	public function onConstruct()
	{

		$this->assets->addCss('//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;display=swap', false);
		// $this->assets->addCss('https://anijs.github.io/lib/anicollection/anicollection.css', false);
		$this->assets->addCss('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css', false);
		//$this->assets->addCss('//cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', false);
		//$this->assets->addCss('css/general.css');
		//$this->assets->addCss('css/animaciones.css');
		
		

		$headerCollection = $this->assets->collection('header');
		// $headerCollection->addJs('js/analytics.js', true, null, ["defer"=>"defer"]);

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/AniJS/0.9.3/anijs-min.js', false);
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/AniJS/0.9.3/helpers/dom/anijs-helper-dom-min.js', false);
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/AniJS/0.9.3/helpers/scrollreveal/anijs-helper-scrollreveal-min.js', false);
		//$footerCollection->addJs('//cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js', false);
		//$footerCollection->addJs('js/general.js', true, null, ["defer"=>"defer"]);

		$this->response->setContentType( "text/html" );
	}

	public function __call($nombre, $args)
	{

		# carga la vista views/{$controller}/{$nombre}
	}
}
