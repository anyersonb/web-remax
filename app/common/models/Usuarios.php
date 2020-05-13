<?php

namespace Easyanuncios\Models;

class Usuarios extends \Phalcon\Mvc\Model
{
	/**
	 * Initialize method for model.
	 */
	public function initialize()
	{
		$this->setSource("usuario");
	}

	public function beforeSave()
	{
		$security =  $this->getDi()->getShared('security');
		if ( isset($this->clave) ) {
			$this->clave = $security->hash($this->clave);
		}
	}

	public function afterFetch(){
		//$this->clave = null;
	}

	public function validar(string $clave)
	{
		$security =  $this->getDi()->getShared('security');
		return $security->checkHash($clave, $this->clave);
	}

}
