<?php

namespace Easyanuncios\Modules\Admin\Controllers;

use Easyanuncios\Models\TiposPlantillas;
use Easyanuncios\Models\Plantillas;
use Easyanuncios\Models\Disegnos;

class DiseñosController extends ControllerBase
{
	public function onConstruct()
	{
		parent::onConstruct();

	}
	public function indexAction()
	{

		$this->assets->addJs('js/diseños.js');
		$idCliente = $this->session->get("cliente")["id"];
		$this->view->disegnos = Disegnos::find([
			"cliente = '$idCliente'",
			"order" => "modificacion DESC"
		]);

	}
	public function deleteAction($id)
	{
		$banner = Disegnos::findFirstById($id);
		$banner->delete();
		$this->response->redirect([
						"for"			=> "adminController",
						"controller"	=> "diseños",
		]);

	}
	public function editorAction()
	{
		$this->assets->addCss("_nuxt/vendors.app.css");
		$this->assets->addCss("_nuxt/app.css");

		$this->assets->addJs("_nuxt/runtime.js");
		$this->assets->addJs("_nuxt/commons.app.js");
		$this->assets->addJs("_nuxt/vendors.app.js");
		$this->assets->addJs("_nuxt/app.js");

		$this->assets->addInlineJs("const cliente = ". $this->session->get("cliente")["id"]);

	}


	public function plantillasAction(int $tipo = null)
	{
		$this->assets->addJs('js/plantillas.js');

		$this->view->tipos = TiposPlantillas::find();
		if ( $tipo ) {
			$this->view->actual = TiposPlantillas::findFirst($tipo);
			$this->view->plantillas = Plantillas::findByTipo($tipo);
		}
	}

}
