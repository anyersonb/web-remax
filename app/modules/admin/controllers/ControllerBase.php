<?php
namespace Easyanuncios\Modules\Admin\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

	public function onConstruct()
	{
		$this->response->setContentType( "text/html" );

		$this->assets->addCss('https://use.fontawesome.com/releases/v5.8.2/css/all.css', false);
		$this->assets->addCss('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;display=swap', false);
		$this->assets->addCss('//cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', false);
		$this->assets->addCss('css/general.css');
		$this->assets->addCss('css/util.css');
		$this->assets->addCss('css/admin.css');
		$this->assets->addCss('fonts/fonts.css');
		$this->assets->addCss('css/style.css');

		$headerCollection = $this->assets->collection('header');
		// $headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.42/polyfill.min.js", false);
		$headerCollection->addJs("https://polyfill.io/v3/polyfill.js?features=es5,es6,es7&flags=gated", false);

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs('//cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js', false);
		$footerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.4.0/smooth-scrollbar.js", false);
		$this->assets->addJs('js/admin.js', true, null, ["defer"=>"defer"]);
	}

	public function __call($nombre, $args)
	{
		echo get_class($this), "\\", $nombre;
	}
}
