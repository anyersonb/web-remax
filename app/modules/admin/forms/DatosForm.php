<?php

namespace Easyanuncios\Modules\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;

use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\StringLength;
use Easyanuncios\Models\Clientes;
use Phalcon\Validation\Validator\Email as ValidatorEmail;

class DatosForm extends BaseForm
{
	
	public function initialize()
	{
		parent::initialize();
		
		$id_cliente = $this->session->get('cliente')['id'];
		$cliente = Clientes::findFirstById($id_cliente);
		
		$nombre = new Text( "nombre" );
		$nombre->setLabel("Nombres:");
		$nombre->setDefault($cliente->nombre);
		//$date->setDefault(date('Y-m-d'));
		$nombre->addValidators([
			new PresenceOf([
				'message' => 'El nombre es obligatorio'
			])
		]);
		$this->add($nombre);

		$apellido = new Text( "apellido" );
		$apellido->setLabel("Apellidos:");
		$apellido->setDefault($cliente->apellido);
		$apellido->addValidators([
			new PresenceOf([
				'message' => 'El apellido es obligatorio'
			])
		]);
		$this->add($apellido);

		$alias = new Text( "alias" );
		$alias->setLabel("Nombre de usuario:");
		$alias->setDefault($cliente->alias);
		$alias->addValidators([
			new PresenceOf([
				'message' => 'El nombre de usuario es obligatorio'
			])
		]);
		$this->add($alias);

		$correo = new Email('correo');
		$correo->setLabel('Correo electrónico:');
		$correo->setDefault($cliente->correo);
		$correo->addValidators([
			new PresenceOf([
				'message' => 'El correo es obligatorio'
			]),
			new ValidatorEmail([
				'message' => 'el correo no es válido'
			])
		]);
		$this->add($correo);
		
		
		$celular = new Text('celular');
		$celular->setLabel('Celular:');
		$celular->setDefault($cliente->celular);
		$this->add($celular);
		
		
		/*
		// Password
		$clave = new Password('clave');
		$clave->setLabel('Contraseña:');
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
		$this->add($clave);

		// Confirm clave
		$confirmar = new Password('confirmar');
		$confirmar->setLabel('Repetir contraseña:');
		$confirmar->addValidators([
			new PresenceOf([
				'message' => 'Es obligatorio repetir la contraseña'
			])
		]);
		$this->add($confirmar);
		*/
		
		/*
		$agente = new Check('agente', [
			'value' => '1'
			]);
		$agente->setLabel('¿Es agente REMAX?');
		$this->add($agente);
		
		$this->add($confirmar);
		$acepta = new Check('acepta', [
			'value' => 'si'
			]);
		$acepta->setLabel('Estoy de acuerdo &nbsp;');
		$acepta->addValidator(new Identical([
				'value' => 'si',
			'message' => 'Debes aceptar los términos y condiciones'
		]));

		$this->add($acepta);
		*/

	}
}
