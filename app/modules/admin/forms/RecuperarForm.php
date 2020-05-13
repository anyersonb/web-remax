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
use Phalcon\Validation\Validator\Email as ValidatorEmail;

class RecuperarForm extends BaseForm
{
	public function initialize()
	{
		parent::initialize();

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
