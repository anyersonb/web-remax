<?php

namespace Easyanuncios\Modules\Control\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as ValidatorEmail;

class ClienteDetalleForm extends BaseForm
{
	public function initialize($usuario = null)
	{
		$nombre = new Text( "nombre" );
		$nombre->setLabel("Nombres:");
		$nombre->addValidators([
			new PresenceOf([
				'message' => 'El nombre es obligatorio'
			])
		]);
		$this->add($nombre);

		$apellido = new Text( "apellido" );
		$apellido->setLabel("Apellidos:");
		$apellido->addValidators([
			new PresenceOf([
				'message' => 'El apellido es obligatorio'
			])
		]);
		$this->add($apellido);

		$alias = new Text( "alias" );
		$alias->setLabel("Nombre de usuario:");
		$alias->addValidators([
			new PresenceOf([
				'message' => 'El nombre de usuario es obligatorio'
			])
		]);
		$this->add($alias);

		$correo = new Email('correo');
		$correo->setLabel('Correo electrónico:');
		$correo->addValidators([
			new PresenceOf([
				'message' => 'El correo es obligatorio'
			]),
			new ValidatorEmail([
				'message' => 'el correo no es válido'
			])
		]);
		$this->add($correo);

	}
}
