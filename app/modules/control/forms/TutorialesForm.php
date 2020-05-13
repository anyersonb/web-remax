<?php

namespace Easyanuncios\Modules\Control\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Email;
use Easyanuncios\Modules\Control\Tags\ImagenControl;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as ValidatorEmail;

class TutorialesForm extends BaseForm
{
	public function initialize($usuario = null)
	{


		$titulo = new Text( "titulo" );
		$titulo->setLabel("Titulo:");
		$titulo->addValidators([
			new PresenceOf([
				'message' => 'El titulo es obligatorio'
			])
		]);
		$this->add($titulo);

		$descripcion = new Text( "descripcion" );
		$descripcion->setLabel("Descripción:");
		$descripcion->addValidators([
			new PresenceOf([
				'message' => 'El descripcion es obligatoria'
			])
		]);
		$this->add($descripcion);
		
		$youtube = new Text( "youtube" );
		$youtube->setLabel("Código YouTube:");
		$this->add($youtube);
		
		$pdf = new Text( "pdf" );
		$pdf->setLabel("Link PDF:");
		$this->add($pdf);

		$imagen = new ImagenControl( "imagen" );
		$imagen->setLabel("Imagen:");
		// $imagen->addValidators([
		// 	new PresenceOf([
		// 		'message' => 'La imagen es obligatoria'
		// 	])
		// ]);
		$this->add($imagen);



	}
}
