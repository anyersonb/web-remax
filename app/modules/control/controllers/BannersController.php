<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Banners;
use Easyanuncios\Modules\Control\Forms\BannersForm as Detalle;



class BannersController extends ControllerBase
{
	public function initialize(){
		parent::initialize();
		$this->tag->appendTitle(' | Banners');
		$this->view->titulo = "Banners";
		$this->view->activo = "banners";
	}

	public function indexAction(){
		$this->view->banners = Banners::find();
		$this->view->operaciones = [
			(object)[
				"ruta" => "control/banners/agregar",
				"titulo" => "Agregar Banner",
				"icono" => "plus"
			],
		];

	}
	public function listarAction(){
		$this->view->titulo = "Banners";
		$this->view->banners = Banners::find();

	}
	
	public function verAction($id)
	{
		$this->view->Preguntasfrecuente = Banners::findFirstById($id);
	}

	public function editarAction($id)
	{
		$banner = Banners::findFirstById($id);
		$detalle = new Detalle($banner);
	
		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$detalle->bind($datos, $banner);
			if ($detalle->isValid()) {
				if ( $banner->update() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "banners",
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
		$this->view->pick("banners/detalle");
		
		
	}
	public function eliminarAction($id)
	{
		$banner = Banners::findFirstById($id);
		$banner->delete();
		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "banners",
		]);
					
		
	}
	public function agregarAction()
	{
		
			$detalle = new Detalle();

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$banner = new Banners();
			$detalle->bind($datos, $banner);
			if ($detalle->isValid()) {

				if ( $banner->create() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "banners",
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
		$this->view->pick("banners/detalle");
	
	}
}
