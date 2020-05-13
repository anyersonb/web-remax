<?php

namespace Easyanuncios\Models;
use Easyanuncios\Models\Behaviors\ImagenModelBehavior;

class Tutoriales extends \Phalcon\Mvc\Model
{
	protected $actualizarClave = false;

	public function initialize()
	{
		$this->setSource("tutoriales");

		$this->addBehavior(new ImagenModelBehavior([
			'beforeCreate' => [
				'campo'      => 'imagen',
				'ruta' => FILES_PATH . "/imagenes/tutoriales",
			],
			'beforeUpdate' => [
				'campo'      => 'imagen',
				'ruta' => FILES_PATH . "/imagenes/tutoriales",
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
