<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Tutoriales;
use Easyanuncios\Modules\Control\Forms\TutorialesForm as Detalle;



class TutorialesController extends ControllerBase
{
	public function initialize(){
		parent::initialize();
		$this->tag->appendTitle(' | Tutoriales');
		$this->view->titulo = "Tutoriales";
		$this->view->activo = "tutoriales";
	}

	public function indexAction(){
		$this->view->tutoriales = Tutoriales::find();
		$this->view->operaciones = [
			(object)[
				"ruta" => "control/tutoriales/agregar",
				"titulo" => "Agregar Tutorial",
				"icono" => "plus"
			],
		];

	}
	public function listarAction(){
		$this->view->titulo = "Tutoriales";
		$this->view->tutoriales = Tutoriales::find();

	}

	public function verAction($id)
	{
		$this->view->Preguntasfrecuente = Tutoriales::findFirstById($id);
	}

	public function editarAction($id)
	{
		$tutorial = Tutoriales::findFirstById($id);
		$detalle = new Detalle($tutorial);

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			// var_dump($datos);
			// exit();
			$detalle->bind($datos, $tutorial);
			if ($detalle->isValid()) {
				if ( $tutorial->update() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "tutoriales",
					]);
				}else{
					foreach ( $tutorial->getMessages() as $message ) {
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
		$this->view->pick("tutoriales/detalle");


	}
	public function eliminarAction($id)
	{
		$tutorial = Tutoriales::findFirstById($id);
		$tutorial->delete();
		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "tutoriales",
		]);


	}
	public function agregarAction()
	{

			$detalle = new Detalle();

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$tutorial = new Tutoriales();
			$detalle->bind($datos, $tutorial);
			if ($detalle->isValid()) {

				if ( $tutorial->create() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "tutoriales",
					]);
				}else{
					foreach ( $tutorial->getMessages() as $message ) {
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
		$this->view->pick("tutoriales/detalle");

	}
}
