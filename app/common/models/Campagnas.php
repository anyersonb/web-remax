<?php

namespace Easyanuncios\Models;

class Campagnas extends \Phalcon\Mvc\Model
{
	const PENDIENTE = "Pendiente";
	const PAGADA = "Pagada";
	const ACTIVA = "Activa";
	const EJECUTADO = "Ejecutado";

	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("campagna");
		$this->belongsTo('anuncio', 'Easyanuncios\Models\Anuncios', 'id', [
			'alias' => 'Anuncio'
		]);
		$this->hasOne('id', 'Easyanuncios\Models\Facturas', 'campagna', ['alias' => 'Factura']);

	}


	public function getPlataformas()
	{
		return $this->Anuncio->Plataformas;
	}
}
