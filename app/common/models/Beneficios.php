<?php

namespace Easyanuncios\Models;
use Easyanuncios\Models\Behaviors\ImagenModelBehavior;

class Beneficios extends \Phalcon\Mvc\Model
{
	protected $actualizarClave = false;

	public function initialize()
	{
		$this->setSource("beneficios");

		$this->addBehavior(new ImagenModelBehavior([
			'beforeCreate' => [
				'campo'      => 'imagen',
				'ruta' => FILES_PATH . "/imagenes/beneficios",
			],
			'beforeUpdate' => [
				'campo'      => 'imagen',
				'ruta' => FILES_PATH . "/imagenes/beneficios",
			],
		]));
	}

	public function getImagen()
	{
		return $this->image;
	}

	public function setImagen($imagen)
	{
		$this->imagen = $imagen;

		return $this;
	}

}
