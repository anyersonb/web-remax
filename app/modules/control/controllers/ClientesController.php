<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Clientes;
use Easyanuncios\Models\Anuncios;
use Easyanuncios\Modules\Control\Forms\ClienteDetalleForm as Detalle;



class ClientesController extends ControllerBase
{
	public function initialize()
	{
		parent::initialize();
		$this->tag->appendTitle(' | Clientes');
		$this->view->titulo = "Clientes";
		$this->view->activo = "clientes";
	}

	public function indexAction()
	{
		$this->view->clientes = Clientes::find();
		$this->view->operaciones = [
			(object)[
				"ruta" => "control/clientes/agregar",
				"titulo" => "Agregar Cliente",
				"icono" => "plus"
			],
		];

	}

	public function listarAction()
	{
		//$this->view->disable();
		$this->view->titulo = "Clientes";
		$this->view->clientes = Clientes::find();
		//$data = json_encode($this->view->getParamsToView());
		//$this->assets->addInlineJs( "const data = $data" );

	}

	public function facturasAction($id)
	{
		//$this->view->disable();
		$this->view->cliente = Clientes::findFirstById($id);
		$this->view->titulo = "Facturas";
		//$data = json_encode($this->view->getParamsToView());
		//$this->assets->addInlineJs( "const data = $data" );

	}

	public function anunciosAction($id)
	{
		$this->view->subtitulo = "anuncios";
		$this->view->cliente = Clientes::findFirstById($id);
		//$this->view->anuncios = Anuncios::findByCliente($id);
	}

	public function publicacionesAction($id)
	{
		$this->view->cliente = Clientes::findFirstById($id);
		//$this->view->anuncios = Anuncios::findByCliente($id);
	}

	public function verAction($id)
	{
		$this->view->cliente = Clientes::findFirstById($id);
	}

	public function editarAction($id)
	{
		$cliente = Clientes::findFirstById($id);
		$detalle = new Detalle($cliente);

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$detalle->bind($datos, $cliente);
			if ($detalle->isValid()) {
				if ( $cliente->update() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "clientes",
					]);
				}else{
					foreach ( $cliente->getMessages() as $message ) {
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
		$this->view->pick("clientes/detalle");
	}

	public function agregarAction()
	{
		$detalle = new Detalle();

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$cliente = new Usuarios();
			$detalle->bind($datos, $cliente);
			if ($detalle->isValid()) {

				if ( $cliente->create() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "clientes",
					]);
				}else{
					foreach ( $cliente->getMessages() as $message ) {
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
		$this->view->pick("clientes/detalle");
	}
}
