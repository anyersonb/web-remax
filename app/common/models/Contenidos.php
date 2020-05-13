<?php

namespace Easyanuncios\Models;

class Contenidos extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("contenido");
		$this->belongsTo("pagina", "Easyanuncios\Models\Paginas", "id");
	}

	public function afterFetch(){
		$this->atributos = json_decode($this->atributos);
	}

	public function beforeSave(){
		$this->atributos = json_encode($this->atributos);
	}

}
