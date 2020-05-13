<?php
namespace Easyanuncios\Modules\Control\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
	// public function onConstruct()
	// {
	// }

	public function initialize()
	{
		//parent::onConstruct();
		$this->assets->addCss('//cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css', false);
		//$this->assets->addCss('https://unpkg.com/ag-grid-community/dist/styles/ag-theme-balham.css', false);

		//$headerCollection = $this->assets->collection('header');
		//$headerCollection->addJs('https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js', false);

		//$footerCollection = $this->assets->collection('footer');
		//$footerCollection->addJs('', false);
		//$footerCollection->addJs('js/general.js', true, null, ["defer"=>"defer"]);

		$this->assets->addCss("//cdnjs.cloudflare.com/ajax/libs/tabulator/4.2.7/css/tabulator.min.css", false);
		$this->assets->addCss("//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", false);
		$this->assets->addCss("//cdnjs.cloudflare.com/ajax/libs/tabulator/4.2.7/css/bulma/tabulator_bulma.min.css", false);
		//$this->assets->addCss("css/control.css", true);

		$this->assets->addCss("http://easyanuncios.com/css/control.css", true);

		// $this->assets->collection('header')
		// ->addJs("https://cdnjs.cloudflare.com/ajax/libs/tabulator/4.2.7/js/tabulator.js", false);
		$this->assets->addJs("//cdnjs.cloudflare.com/ajax/libs/tabulator/4.2.7/js/tabulator.js", false);
		//Iconos
		$this->assets->addJs("//cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js", false);
		$this->assets->addInlineJs("feather.replace()");

		$this->tag->setTitle('EasyAnuncios');

		$this->view->activo = ".";

		$this->response->setContentType( "text/html" );
	}

	public function __call($nombre, $args)
	{
		echo get_class($this), "\\", $nombre;
		if ( count( $args )) {
			var_dump($args);
		}
		var_dump($this->dispatcher->getParams());
	}
}
