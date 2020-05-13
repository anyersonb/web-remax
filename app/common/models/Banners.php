<?php

namespace Easyanuncios\Models;
use Easyanuncios\Models\Behaviors\ImagenModelBehavior;

class Banners extends \Phalcon\Mvc\Model
{
	protected $actualizarClave = false;

	public function initialize()
	{
		$this->setSource("banners");

		$this->addBehavior(new ImagenModelBehavior([
			'beforeCreate' => [
				'campo'      => 'imagen',
				'ruta' => FILES_PATH . "/imagenes/banners",
			],
			'beforeUpdate' => [
				'campo'      => 'imagen',
				'ruta' => FILES_PATH . "/imagenes/banners",
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
