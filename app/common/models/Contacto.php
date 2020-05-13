<?php

namespace Easyanuncios\Models;
use Easyanuncios\Models\Behaviors\ImagenModelBehavior;

class Contacto extends \Phalcon\Mvc\Model
{
	public function initialize()
	{
		$this->setSource("contacto");

	}


}
