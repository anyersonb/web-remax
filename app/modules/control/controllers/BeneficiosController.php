<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Beneficios;
use Easyanuncios\Modules\Control\Forms\BeneficiosForm as Detalle;



class BeneficiosController extends ControllerBase
{
	public function initialize(){
		parent::initialize();
		$this->tag->appendTitle(' | Beneficios');
		$this->view->titulo = "Beneficios";
		$this->view->activo = "Beneficios";
	}

	public function indexAction(){
		$this->view->beneficios = Beneficios::find();
		$this->view->operaciones = [
			(object)[
				"ruta" => "control/beneficios/agregar",
				"titulo" => "Agregar Beneficio",
				"icono" => "plus"
			],
		];

	}
	public function listarAction(){
		$this->view->titulo = "Beneficios";
		$this->view->Beneficios = Beneficios::find();

	}

	public function verAction($id)
	{
		$this->view->Preguntasfrecuente = Beneficios::findFirstById($id);
	}

	public function editarAction($id)
	{
		$banner = Beneficios::findFirstById($id);
		$detalle = new Detalle($banner);

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$detalle->bind($datos, $banner);
			if ($detalle->isValid()) {
				if ( $banner->update() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "beneficios",
					]);
				}else{
					foreach ( $banner->getMessages() as $message ) {
						$this->flash->error(
							$message->getMessage()
						);
					}
				}

			}
			else{
				foreach ( $detalle->getMessages() as $message ) {
					$this->flash->error(
						$message->getMessage()
					);
				}
			}
		}

		$this->view->form = $detalle;
		$this->view->pick("beneficios/detalle");


	}
	public function eliminarAction($id)
	{
		$banner = Beneficios::findFirstById($id);
		$banner->delete();
		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "beneficios",
		]);


	}
	public function agregarAction()
	{

			$detalle = new Detalle();

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$banner = new Beneficios();
			$detalle->bind($datos, $banner);
			if ($detalle->isValid()) {

				if ( $banner->create() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "beneficios",
					]);
				}else{
					foreach ( $banner->getMessages() as $message ) {
						$this->flash->error(
							$message->getMessage()
						);
					}
				}

			}
			else{
				foreach ( $detalle->getMessages() as $message ) {
					$this->flash->error(
						$message->getMessage()
					);
				}
			}
		}

		$this->view->form = $detalle;
		$this->view->pick("beneficios/detalle");

	}
}
