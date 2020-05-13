<?php

namespace Easyanuncios\Modules\System\Controllers;

use Unirest\Request;
use Easyanuncios\Models\Ubigeo;


class ApiController extends ControllerBase
{

	public function ciudadesAction(){
		$parametros = [
			"access_token" => $this->config->facebook->app_token,
			"type" => "adgeolocation",
			"location_types" => ["city"],
			"q" => $this->request->get("nombre")
		];
		$url = "https://graph.facebook.com/v5.0/"."search";

		$response = Request::get($url, [], $parametros);
		print_r($response->body);

		$lista = array_filter($response->body->data, function($item){
			return $item->country_code == "PE";
		});

		$lista = array_values(array_map(function($item){
			//return $item->name;
			return [
					"value" => $item->name,
					"data" => $item->key
			];
		}, $lista));

		$rpta = [
			"query"=> "Unit",
			"suggestions" => $lista
		];

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($rpta));
		return $this->response;
	}


	public function departamentosAction()
	{
		$lista = Ubigeo::departamentos();

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($lista));
		return $this->response;
	}

	public function provinciasAction(Int $departamento = 0)
	{
		$lista = Ubigeo::provincias($departamento);

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($lista));
		return $this->response;
	}

	public function distritosAction(Int $departamento = 0, Int $provincia = 0)
	{
		$lista = Ubigeo::distritos($departamento, $provincia);

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($lista));
		return $this->response;
	}
}
