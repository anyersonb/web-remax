<?php

namespace Easyanuncios\Models;

class Temporales extends \Phalcon\Mvc\Model
{
	public function initialize()
	{
		$this->setSource("temporal");
		$this->belongsTo('cliente', 'Easyanuncios\Models\Clientes', 'id', ['alias' => 'Cliente']);
	}

}
