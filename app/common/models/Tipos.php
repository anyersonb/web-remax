<?php

namespace Easyanuncios\Models;

class Tipos extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("tipo");
		$this->hasManyToMany(
			"id",
			"Easyanuncios\Models\TiposPlataformas",
			"tipo", "plataforma",
			"Easyanuncios\Models\Plataformas",
			"id",[
				"alias" => "Plataformas"
			]
		);
	}

}
