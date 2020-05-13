<?php

namespace Easyanuncios\Modules\Admin\Controllers;

use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Campagnas;

class FacturacionController extends ControllerBase
{
	public function initialize()
	{
		$this->view->titulo = "Facturas";
	}

	public function indexAction()
	{
		$cliente = $this->session->get('cliente');
		$this->view->anuncios = Anuncios::find([
			"cliente = ?1",
			"bind" => [
				1 => $cliente["id"]
			],
			'order' => 'creacion DESC',
			'limit' => 50,
		]);
	}
}
