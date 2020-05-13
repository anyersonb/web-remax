<?php

namespace Easyanuncios\Modules\Control\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Email;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as ValidatorEmail;

class PreguntasFrecuentesForm extends BaseForm
{
	public function initialize($usuario = null)
	{
		$pregunta = new Text( "pregunta" );
		$pregunta->setLabel("Pregunta:");
		$pregunta->addValidators([
			new PresenceOf([
				'message' => 'La pregunta es obligatoria'
			])
		]);
		$this->add($pregunta);

		$respuesta = new TextArea( "respuesta");
		$respuesta->setAttributes([ 'cols' => '6', 'rows' => '50']);
		$respuesta->setLabel("Respuesta:");
		$respuesta->addValidators([
			new PresenceOf([
				'message' => 'La respuesta es obligatoria'
			])
		]);
		$this->add($respuesta);



	}
}
