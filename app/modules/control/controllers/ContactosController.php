<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Contacto;
use Easyanuncios\Modules\Control\Forms\BeneficiosForm as Detalle;



class ContactosController extends ControllerBase
{
	public function initialize(){
		parent::initialize();
		$this->tag->appendTitle(' | Contacto');
		$this->view->titulo = "Contacto";
		$this->view->activo = "Contacto";
	}

	public function indexAction(){
		$this->view->contactos = Contacto::find();
	}
	public function listarAction(){
		$this->view->titulo = "Contacto";
		$this->view->contactos = Contacto::find();

	}

	public function eliminarAction($id)
	{
		$banner = Contacto::findFirstById($id);
		$banner->delete();
		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "contactos",
		]);


	}

}
