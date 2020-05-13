<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Preguntasfrecuentes;
use Easyanuncios\Modules\Control\Forms\PreguntasFrecuentesForm as Detalle;



class PreguntasfrecuentesController extends ControllerBase
{
	public function initialize(){
		parent::initialize();
		$this->tag->appendTitle(' | Preguntas Frecuentes');
		$this->view->titulo = "Preguntas Frecuentes";
		$this->view->activo = "preguntasfrecuentes";
	}

	public function indexAction(){
		$this->view->preguntasfrecuentes = Preguntasfrecuentes::find();
		$this->view->operaciones = [
			(object)[
				"ruta" => "control/preguntasfrecuentes/agregar",
				"titulo" => "Agregar Pregunta Frecuente",
				"icono" => "plus"
			],
		];

	}
	public function listarAction(){
		$this->view->titulo = "Preguntas Frecuentes";
		$this->view->preguntasfrecuentes = Preguntasfrecuentes::find();

	}
	
	public function verAction($id)
	{
		$this->view->Preguntasfrecuente = Preguntasfrecuentes::findFirstById($id);
	}

	public function editarAction($id)
	{
		$preguntasfrecuente = Preguntasfrecuentes::findFirstById($id);
		$detalle = new Detalle($preguntasfrecuente);
	
		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$detalle->bind($datos, $preguntasfrecuente);
			if ($detalle->isValid()) {
				if ( $preguntasfrecuente->update() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "preguntasfrecuentes",
					]);
				}else{
					foreach ( $preguntasfrecuente->getMessages() as $message ) {
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
		$this->view->pick("preguntasfrecuentes/detalle");
		
		
	}
	public function eliminarAction($id)
	{
		$preguntasfrecuente = Preguntasfrecuentes::findFirstById($id);
		$preguntasfrecuente->delete();
		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "preguntasfrecuentes",
		]);
					
		
	}
	public function agregarAction()
	{
		
			$detalle = new Detalle();

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$preguntasfrecuente = new Preguntasfrecuentes();
			$detalle->bind($datos, $preguntasfrecuente);
			if ($detalle->isValid()) {

				if ( $preguntasfrecuente->create() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "preguntasfrecuentes",
					]);
				}else{
					foreach ( $preguntasfrecuente->getMessages() as $message ) {
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
		$this->view->pick("preguntasfrecuentes/detalle");
	
	}
}
