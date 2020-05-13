<?php

namespace Easyanuncios\Models;

class Diseños extends \Phalcon\Mvc\Model
{
	public function initialize()
	{
		$this->setSource("diseño");
		$this->hasOne(
			"tipo",
			"Easyanuncios\Models\Clientes",
			"id",
			[
				'reusable' => true, // cache related data
				'alias'    => 'Cliente',
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
