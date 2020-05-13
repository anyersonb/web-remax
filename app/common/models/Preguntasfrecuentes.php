<?php

namespace Easyanuncios\Models;

class Preguntasfrecuentes extends \Phalcon\Mvc\Model
{
	protected $actualizarClave = false;

	public function initialize()
	{
		$this->setSource("preguntasfrecuentes");
	}

}
