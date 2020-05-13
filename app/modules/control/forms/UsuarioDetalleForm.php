<?php

namespace Easyanuncios\Modules\Control\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;

use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

use Easyanuncios\Models\Usuarios;

class UsuarioDetalleForm extends BaseForm
{
	public function initialize(Usuarios $usuario = null)
	{
		//parent::initialize($usuario);
		//$this->_entity = $usuario;

		$editar = false;

		if (!empty($usuario)) {
			$editar = true;
		}

		$nombre = new Text( "nombre" );
		$nombre->setLabel("Nombre:");
		$nombre->addValidators([
			new PresenceOf([
				'message' => 'El nombre de usuario es obligatorio'
			])
		]);
		$this->add($nombre);

		// Password
		$clave = new Password('clave');
		$clave->setLabel('Contraseña:');

		$this->add($clave);

		if ($editar) {
			// se crea un nuevo usuario
		}else{

			$clave->addValidators([
				new PresenceOf([
					'message' => 'La contraseña es obligatoria'
				]),
				new StringLength([
					'min' => 8,
					'messageMinimum' => 'La clave es muy corta, debe tener al menos 8 caracteres'
				]),
				new Confirmation([
					'message' => 'Las contraseñas no coinciden',
					'with' => 'confirmar'
				])
			]);

			// Confirmar clave
			$confirmar = new Password('confirmar');
			$confirmar->setLabel('Repetir contraseña:');
			$confirmar->addValidators([
				new PresenceOf([
					'message' => 'Es obligatorio repetir la contraseña'
				])
			]);
			$this->add($confirmar);
		}
	}
}
