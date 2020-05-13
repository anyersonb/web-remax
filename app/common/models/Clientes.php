<?php

namespace Easyanuncios\Models;

class Clientes extends \Phalcon\Mvc\Model
{
	protected $actualizarClave = false;

	public function initialize()
	{
		$this->setSource("cliente");
		$this->hasMany('id', 'Easyanuncios\Models\Anuncios', 'cliente', ['alias' => 'Anuncios']);
		$this->hasMany('id', 'Easyanuncios\Models\Publicaciones', 'cliente', ['alias' => 'Publicaciones']);
		$this->hasMany('id', 'Easyanuncios\Models\Temporales', 'cliente', [
			'alias' => 'Temporales'
		]);

		$this->skipAttributes([
			"nombreCompleto"
		]);
	}

	public function beforeSave()
	{
		$this->alias = strtolower($this->alias);
		if(empty($this->clave)){
			$this->skipAttributes(["clave"]);
		}
		else{
			$this->clave = hash( "sha256", $this->clave );
		}
	}

	public static function validar( string $alias, string $clave ){
		$u = self::findFirstByAlias($alias);
		if (!$u) {
			$u = self::findFirstByCorreo($alias);
		}

		if ($u && $u->clave == hash( "sha256", $clave )) {
			return $u;
		}else{
			return false;
		}
	}
}
