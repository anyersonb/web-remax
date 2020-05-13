<?php

namespace Easyanuncios\Modules\Web\Controllers;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;

use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Email as ValidatorEmail;

class ContactoForm extends BaseForm
{
	public function initialize()
	{
		parent::initialize();

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

		
		$alias = new Text( "celular" );
		$alias->setLabel("Celular:");
		$alias->addValidators([
			new PresenceOf([
				'message' => 'Ingresar su número de celular'
			])
		]);
		$this->add($alias);
		
		$alias = new TextArea( "mensaje" , array("cols" => 80, "rows" => 8));
		$alias->setLabel("Mensaje:");
		$alias->addValidators([
			new PresenceOf([
				'message' => 'Ingresar un mensaje'
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



		$agente = new Check('agente', [
			'value' => 'si'
			]);
		$agente->setLabel('Estoy de acuerdo &nbsp;');
		/*$agente->addValidator(new Identical([
				'value' => 'si',
			'message' => 'Debes agenter los términos y condiciones'
		]));*/


		$this->add($agente);

	}
}
