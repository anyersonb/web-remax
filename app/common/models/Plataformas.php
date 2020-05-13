<?php

namespace Easyanuncios\Models;

class Plataformas extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("plataforma");
	}

}
