<?php

namespace Easyanuncios\Models;

class TiposPlantillas extends \Phalcon\Mvc\Model
{
	public function initialize()
	{
		$this->setSource("tipoPlantilla");
		$this->hasMany("id",
			"Easyanuncios\Models\Plantillas",
			"tipo",
			[
				'reusable' => true, // cache related data
				'alias'    => 'Plantillas',
			]
		);
	}
}
