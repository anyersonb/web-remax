<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Clientes;
use Easyanuncios\Models\Campagnas;

class AnunciosController extends ControllerBase
{
	protected $actual = "anuncios";
	public function initialize()
	{
		parent::initialize();
		$this->view->titulo = "Anuncios";
		$this->tag->appendTitle(' > Anuncios');
	}

	public function indexAction()
	{
		$this->response->redirect([
			"for"			=> "controlControllerAction",
			"controller"	=> "anuncios",
			"action"		=> "listar",
			"params"		=> $id
		]);
	}
	public function listarAction()
	{
		//$this->view->disable();
		$this->view->anuncios = Anuncios::find([
			"order" => "creacion DESC"
		]);

	}

	public function verAction($id)
	{
		//$this->view->disable();
		//$cliente = Clientes::findFirstById($id);
		//print_r($cliente->nombre);
		$this->view->anuncio = Anuncios::findFirstById($id);

	}

	public function aprobarAction($id)
	{
		$anuncio = Anuncios::findFirstById($id);
		$anuncio->estado = Anuncios::APROBADO;
		$anuncio->save();

		$this->response->redirect([
			"for"			=> "controlControllerAction",
			"controller"	=> "anuncios",
			"action"		=> "ver",
			"params"		=> $id
		]);
	}

	public function rechazarAction($id)
	{
		$anuncio = Anuncios::findFirstById($id);
		$anuncio->estado = Anuncios::RECHAZADO;
		$anuncio->save();

		$this->response->redirect([
			"for"			=> "controlControllerAction",
			"controller"	=> "anuncios",
			"action"		=> "ver",
			"params"		=> $id
		]);
	}


	public function publicarAction($id)
	{
		$campagna = Campagnas::findFirstById($id);
		$campagna->estado = Campagnas::ACTIVA;
		$campagna->save();

		$this->response->redirect([
			"for"			=> "controlControllerAction",
			"controller"	=> "anuncios",
			"action"		=> "ver",
			"params"		=> $id
		]);
	}

	public function publicacionesAction($id)
	{
		//$this->view->disable();
		//$cliente = Clientes::findFirstById($id);
		//print_r($cliente->nombre);
		$this->view->anuncio = Anuncios::findFirstById($id);

	}
}
