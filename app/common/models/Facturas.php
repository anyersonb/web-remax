<?php

namespace Easyanuncios\Models;

use Phalcon\Security\Random;

class Facturas extends \Phalcon\Mvc\Model
{

	const CREADO = "Creado";
	const PAGADO = "Pagado";
	const RECHAZADO = "Rechazado";

	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("factura");
		$this->belongsTo('campagna', 'Easyanuncios\Models\Campagnas', 'id', ['alias' => 'Campagna']);
	}

	public static function generar($campagnaId)
	{
		$campagna = Campagnas::FindFirst($campagnaId);
		if ($campagna) {
			if ($campagna->estado == Campagnas::PENDIENTE) {
				$factura = new Self([
					"campagna" => $campagnaId,
					"codigo" => "FCT" . strtoupper(uniqid())
				]);
				if ($factura->create()) {
					$factura->refresh();
					$rpta = $factura;
				}

			}else{
				$rpta = [
					"error" => true,
					"mensaje" => "La campagna está pagada"
				];
			}

		}else{
			$rpta = [
				"error" => true,
				"mensaje" => "No existe la campaña"
			];
		}

		return $rpta;

	}

}
