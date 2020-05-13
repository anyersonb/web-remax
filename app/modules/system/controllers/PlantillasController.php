<?php

namespace Easyanuncios\Modules\System\Controllers;

use Easyanuncios\Models\Plantillas;
use Easyanuncios\Models\TiposPlantillas;


class PlantillasController extends ControllerBase
{

	public function indexAction(){

		$rpta = [];

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($rpta));
		return $this->response;
	}
	public function obtenerAction(int $id)	{		$rpta = Plantillas::findFirst($id);		$this->response->setContent(json_encode($rpta));		return $this->response;	}

	public function tiposAction()
	{
		$lista = TiposPlantillas::find();

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($lista));
		return $this->response;
	}

}
