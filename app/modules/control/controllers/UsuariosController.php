<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Usuarios;
use Easyanuncios\Modules\Control\Forms\UsuarioDetalleForm as Detalle;


class UsuariosController extends ControllerBase
{
	public function initialize()
	{
		parent::initialize();
		$this->view->titulo .= "Usuarios";
		$this->tag->appendTitle(' > Usuarios');
		$this->view->activo = "usuarios";
	}

	public function indexAction()
	{
		$this->view->usuarios = Usuarios::find();

		$this->view->operaciones = [
			(object)[
				"ruta" => "control/usuarios/agregar",
				"titulo" => "Agregar Usuario",
				"icono" => "plus"
			],
		];


	}

	public function agregarAction()
	{
		$detalle = new Detalle();

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			if ($detalle->isValid($datos)) {

				$usuario = new Usuarios();
				$usuario->assign($datos);
				//$usuario->save();

				if ( $usuario->create() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "usuarios",
					]);
				}else{
					foreach ( $usuario->getMessages() as $message ) {
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

		$this->view->pick("usuarios/detalle");
	}

	public function editarAction(int $id)
	{
		$usuario = Usuarios::findFirstById($id);
		$usuario->clave = "";
		$detalle = new Detalle($usuario);

		if ($this->request->isPost()) {
			$datos = $this->request->getPost();
			$detalle->bind($datos, $usuario);
			if ($detalle->isValid()) {

				if ( $usuario->update() ) {
					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "usuarios",
					]);
				}else{
					foreach ( $usuario->getMessages() as $message ) {
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
				$usuario->clave = "";
			}
		}


		$this->view->form = $detalle;
		$this->view->pick("usuarios/detalle");
	}

	public function loginAction()
	{

		if ($this->request->isPost()) {

			$nombre = strtolower($this->request->getPost('nombre'));
			$clave = trim($this->request->getPost('clave'));
			$usuario = Usuarios::findFirstByNombre($nombre);

			if ( $usuario ) {
				if ( $usuario->validar($clave) ) {
					$this->_registrarSesion($usuario->toArray());


					$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "clientes",
					]);
				}
				else{
					$this->flashsession->error(
						'Error al iniciar sesión.'
					);
				}


			}
			else{
				$this->flashsession->error(
						'Error al iniciar sesión'
					);
			}


		}
		$this->view->setMainView ("simple");
	}

	private function _registrarSesion($usuario)
	{
		$this->session->set(
			'usuario',
			$usuario
		);
	}

	public function salirAction()
	{
		$this->session->set(
			'cliente',
			false
		);
		$this->response->redirect("control/usuarios/login");
	}
}
