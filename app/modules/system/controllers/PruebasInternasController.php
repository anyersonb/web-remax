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

use FacebookAds\Object\Targeting;
use FacebookAds\Object\Fields\TargetingFields;
use FacebookAds\Object\TargetingGeoLocationCity;

use GuzzleHttp\Client;
use Unirest\Request;


class PruebasInternasController extends ControllerBase
{

	public function indexAction()
	{
		$this->response->setContentType( "text/html" );
		//echo "algo";
	}

	public function ciudadesAction(){
		$parametros = [
			"access_token" => $this->config->facebook->app_token,
			"type" => "adgeolocation",
			"location_types" => ["city"],
			"q" => $this->request->get("nombre")
		];
		$url = "https://graph.facebook.com/v5.0/"."search";

		$response = Request::get($url, [], $parametros);
		$this->response->setContentType( "application/json" );
		$this->response->setContent($response->raw_body);
		return $this->response;
	}
}
