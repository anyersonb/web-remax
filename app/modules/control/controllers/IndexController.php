<?php

namespace Easyanuncios\Modules\Control\Controllers;


class IndexController extends ControllerBase
{

	public function indexAction()
	{

		$this->response->redirect([
			"for"			=> "controlControllerAction",
			"controller"	=> "Clientes",
			'action'		=> '',
		]);
		
		
	}

}
