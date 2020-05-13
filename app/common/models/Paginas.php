<?php

namespace Easyanuncios\Models;

class Paginas extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("pagina");
		$this->hasMany('id', 'Easyanuncios\Models\Contenidos', "pagina",[
			"alias" => "Contenidos"
		]);
	}

}
