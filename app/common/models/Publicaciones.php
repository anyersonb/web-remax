<?php

namespace Easyanuncios\Models;

class Publicaciones extends \Phalcon\Mvc\Model
{

	/**
	 * @var string
	 *
	 */
	public $atributos;

	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("publicacion");
		$this->belongsTo('cliente', 'Easyanuncios\Models\Clientes', 'id', ['alias' => 'Cliente']);
	}

	public function afterFetch(){
		$this->atributos = json_decode($this->atributos);
	}

	public function beforeSave(){
		$this->atributos = json_encode($this->atributos);
	}
}
