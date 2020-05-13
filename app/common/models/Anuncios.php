<?php

namespace Easyanuncios\Models;

class Anuncios extends \Phalcon\Mvc\Model
{

	const CREADO = "Creado";
	const APROBADO = "Aprobado";
	const ACTIVO = "Activo";
	const INACTIVO = "Inactivo";
	const RECHAZADO = "Rechazado";

	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("anuncio");
		//$this->hasMany('id', 'EasyAnuncios\model\Composicion', 'anuncio', ['alias' => 'Composicion']);
		$this->hasOne('tipo', 'Easyanuncios\Models\Tipos', 'id', ['alias' => 'Tipo']);
		//$this->belongsTo('tipo', 'EasyAnuncios\Models\Tipos', 'id', ['alias' => 'Tipo']);
		$this->hasOne('cliente', 'Easyanuncios\Models\Clientes', 'id', ['alias' => 'Cliente']);
		$this->hasMany('id', 'Easyanuncios\Models\Campagnas', 'anuncio', ['alias' => 'Campagnas']);
		$this->hasMany('id', 'Easyanuncios\Models\Difusiones', 'anuncio', ['alias' => 'Difusiones']);
	}

	public function getPlataformas()
	{
		return $this->Tipo->Plataformas;
	}
}
