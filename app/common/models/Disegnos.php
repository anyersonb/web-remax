<?php

namespace Easyanuncios\Models;

class Disegnos extends \Phalcon\Mvc\Model
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
		$this->previo = "data:image/png;base64," . base64_encode($this->previo);
	}

	public function beforeSave()
	{
		$this->datos = json_encode($this->datos);

		$png1px = "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=";
		$this->previo = base64_decode(explode("base64,", $this->previo)[1] ?: $png1px);
	}
}
