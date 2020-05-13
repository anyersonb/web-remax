<?php

namespace Easyanuncios\Models;

class Ubigeo extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */

	static public function departamentos(){
		$criterios = [
			"provincia = 0 AND distrito = 0",
			"columns" => "departamento AS id, nombre, codigo as ubigeo",
			'cache' => ['lifetime' => 3.154e+7, 'key' => 'departamentos']
		];

		return self::find($criterios);
	}

	static public function provincias(Int $departamento = 0){
		$condicion = "";
		if ($departamento) {
			$condicion .= "departamento = $departamento AND ";
		}
		$condicion .= "provincia > 0 AND distrito = 0";

		$criterios = [
			$condicion,
			"columns" => "provincia AS id, nombre, codigo as ubigeo",
			'cache' => ['lifetime' => 3.154e+7, 'key' => "provincias-$departamento"]
		];

		return self::find($criterios);
	}

	static public function distritos(Int $departamento = 0, Int $provincia = 0){
		$condicion = "";
		if ($departamento) {
			$condicion .= "departamento = $departamento AND ";
		}
		if ($provincia) {
			$condicion .= "provincia = $provincia AND ";
		}
		$condicion .= "distrito > 0";

		$criterios = [
			$condicion,
			"columns" => "distrito AS id, nombre, codigo as ubigeo",
			'cache' => ['lifetime' => 3.154e+7, 'key' => "distritos-$departamento-$provincia"]
		];

		return self::find($criterios);
	}
}
