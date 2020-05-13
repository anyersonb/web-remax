<?php

namespace Easyanuncios\Models;

class TiposPlataformas extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("tipoPlataforma");
	}

}
