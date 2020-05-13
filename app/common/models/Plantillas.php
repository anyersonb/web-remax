<?php

namespace Easyanuncios\Models;

class Plantillas extends \Phalcon\Mvc\Model
{
	public function initialize()
	{
		$this->setSource("plantilla");
		$this->hasOne(
			"tipo",
			"Easyanuncios\Models\TiposPlantillas",
			"id",
			[
				'reusable' => true, // cache related data
				'alias'    => 'Tipo',
			]
		);
	}

	public function afterFetch()
	{
		$this->datos = json_decode($this->datos);
	}

	public function beforeSave()
	{
		$this->datos = json_encode($this->datos);
	}
}
