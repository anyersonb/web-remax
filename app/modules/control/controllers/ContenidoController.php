<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Paginas;
use Easyanuncios\Models\Contenidos;

class ContenidoController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
		$this->tag->appendTitle(' | Contenido');
		$this->view->titulo = "Contenido";
		$this->view->activo = "Contenido";
	}

	public function indexAction()
	{
		
		$nosotros = Contenidos::findFirstByNombre("nosotros");
		$nosotros2 = Contenidos::findFirstByNombre("nosotros2");
		$nosotros3 = Contenidos::findFirstByNombre("nosotros3");
		$contenido = Contenidos::findFirstByNombre("videoInicio");
		$mensaje = Contenidos::findFirstByNombre("correoRegistro");
		$tyc = Contenidos::findFirstByNombre("terminosycondiciones");
		$politica = Contenidos::findFirstByNombre("politicadeprivacidad");
		$email = Contenidos::findFirstByNombre("email");
		$this->view->nosotros = $nosotros;
		$this->view->nosotros2 = $nosotros2;
		$this->view->nosotros3 = $nosotros3;
		$this->view->tyc = $tyc;
		$this->view->video = $contenido;
		$this->view->mensaje = $mensaje;
		$this->view->politica = $politica;
		$this->view->email = $email;
	}

	public function guardarVideoAction(){
		$datos = $this->request->getPost();

		parse_str( parse_url( $datos["url"], PHP_URL_QUERY ), $valores );

		$vid = $valores['v'];

		$contenido = <<<FDHTML
<iframe
src="https://www.youtube.com/embed/$vid"
frameborder="0"
allow="autoplay; encrypted-media; picture-in-picture"
allowfullscreen=""></iframe>
FDHTML;

		$video = Contenidos::findFirstByNombre("videoInicio");

		$video->objeto = $contenido;
		$video->atributos->id = $vid;
		$video->atributos->url = $datos["url"];

		$video->save();

		$this->flashSession->success(
			"Video Actualizado"
		);

		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "contenido",
					]);
	}
	public function guardarNosotrosAction(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("nosotros");
		$mensaje->objeto = $datos["objeto"];
		$mensaje->save();
		$this->flashSession->success(
			"Datos Actualizados"
		);
		$this->response->redirect([
				"for"			=> "controlController",
				"controller"	=> "contenido",
		]);
	}
	public function guardarNosotros2Action(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("nosotros2");
		$mensaje->objeto = $datos["objeto"];
		$mensaje->save();
		$this->flashSession->success(
			"Datos Actualizados"
		);
		$this->response->redirect([
				"for"			=> "controlController",
				"controller"	=> "contenido",
		]);
	}
	public function guardarNosotros3Action(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("nosotros3");
		$mensaje->objeto = $datos["objeto"];
		$mensaje->save();
		$this->flashSession->success(
			"Datos Actualizados"
		);
		$this->response->redirect([
				"for"			=> "controlController",
				"controller"	=> "contenido",
		]);
	}
	public function guardarTerminosAction(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("terminosycondiciones");
		$mensaje->objeto = $datos["objeto"];
		$mensaje->save();
		$this->flashSession->success(
			"Datos Actualizados"
		);
		$this->response->redirect([
				"for"			=> "controlController",
				"controller"	=> "contenido",
		]);
	}
	public function guardarEmailAction(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("email");
		$mensaje->objeto = $datos["email"];
		$mensaje->save();
		$this->flashSession->success(
			"Datos Actualizados"
		);
		$this->response->redirect([
				"for"			=> "controlController",
				"controller"	=> "contenido",
		]);
	}
	public function guardarPoliticasAction(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("politicadeprivacidad");
		$mensaje->objeto = $datos["objeto"];
		$mensaje->save();
		$this->flashSession->success(
			"Datos Actualizados"
		);
		$this->response->redirect([
				"for"			=> "controlController",
				"controller"	=> "contenido",
		]);
	}

	public function guardarCorreoAction(){
		$datos = $this->request->getPost();
		$mensaje = Contenidos::findFirstByNombre("correoRegistro");

		$mensaje->titulo = $datos["titulo"];
		$mensaje->objeto = $datos["objeto"];
		$mensaje->save();

		$this->flashSession->success(
			"Correo Actualizado"
		);

		$this->response->redirect([
						"for"			=> "controlController",
						"controller"	=> "contenido",
					]);
	}

}
