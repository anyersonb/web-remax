<?php

namespace Easyanuncios\Models;

class TiposContenido extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("tipoContenido");
		$this->belongsTo("id", "Easyanuncios\Models\Contenidos", "");
	}

}
