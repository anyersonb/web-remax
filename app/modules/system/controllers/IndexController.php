<?php

namespace Easyanuncios\Modules\System\Controllers;

use Easyanuncios\Models\Campagnas;
use Easyanuncios\Models\Facturas;
use Easyanuncios\Models\Difusiones;
use Easyanuncios\Models\Contenidos;

use Phalcon\Security\Random;

use FacebookAds\Api;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSearchTypes;


class IndexController extends ControllerBase
{

	public function indexAction()
	{
		$this->response->setContentType( "text/html" );
	}

	public function pruebaAction()
	{
		// $fb = $this->fbHelper;

		$result = TargetingSearch::search(
				TargetingSearchTypes::GEOLOCATION,
				null,
				'9',
				array(
					'location_types' => array('zip'),
				),
				$this->fbHelper->api
			);

		$this->response->setContentType( "text/html" );
		// print_r($result->current());
		var_dump($result->current());
	}



	public function pruebaUnoAction()
	{
		echo ("pruebaUnoAction");
	}
}
