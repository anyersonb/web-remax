<?php

namespace Easyanuncios\Models;

class Difusiones extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("difusion");
		$this->belongsTo('publicacion', 'Easyanuncios\Models\Publicaciones', 'id', [
			'alias' => 'Publicacion'
		]);
		$this->belongsTo('anuncio', 'Easyanuncios\Models\Anuncios', 'id', [
			'alias' => 'Anuncio'
		]);
	}

	public function afterFetch(){
		$this->atributos = json_decode($this->atributos);
	}

	public function beforeSave(){
		$this->atributos = json_encode($this->atributos);
	}

}
