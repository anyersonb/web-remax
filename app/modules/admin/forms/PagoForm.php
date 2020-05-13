<?php

namespace Easyanuncios\Modules\Admin\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\CreditCard as CreditCardValidator;
use Phalcon\Validation\Validator\Regex as RegexValidator;


class PagoForm extends BaseForm
{
	public function initialize($usuario = null)
	{
		$nombre = new Text( "nombre" );
		$nombre->setLabel("Nombre:");
		$nombre->setAttributes([
			"class"=> "input nombre"
		]);
		$nombre->addValidators([
			new PresenceOf([
				'message' => 'El nombre es obligatorio'
			])
		]);
		$this->add($nombre);

		$apellido = new Text( "apellido" );
		$apellido->setLabel("Apellido:");
		$apellido->setAttributes([
			"class"=> "input apellido"
		]);
		$apellido->addValidators([
			new PresenceOf([
				'message' => 'El apellido es obligatorio'
			])
		]);
		$this->add($apellido);

		$tarjeta = new Text( "tarjeta" );
		$tarjeta->setLabel("Número de tarjeta:");
		$tarjeta->setAttributes([
			"class"=> "input tarjeta",
			"placeholder" => "9999 9999 9999 9999",
		]);
		$tarjeta->addValidators([
			new CreditCardValidator(
				[
					"message" => "El Número de tarjeta no es válido",
				]
			)
		]);
		$this->add($tarjeta);

		$cvv = new Text( "cvv" );
		$cvv->setLabel("CVV:");
		$cvv->setAttributes([
			"class"=> "input cvv",
			"placeholder" => "999",
			"maxlength" => 4
		]);
		$cvv->addValidators([
			new PresenceOf([
				'message' => 'El CVV de tarjeta es obligatorio'
			]),
			new RegexValidator(
			[
				"pattern" => "/^[0-9]{3,4}$/",
				"message" => "El CVV de tarjeta es inválido",
			])
		]);
		$this->add($cvv);

		$vencimiento = new Text( "vencimiento" );
		$vencimiento->setLabel("Fecha de Vencimiento:");
		$vencimiento->setAttributes([
			"class"=> "input vencimiento",
			"placeholder" => "mm/aa"
		]);
		$vencimiento->addValidators([
			new RegexValidator(
			[
				"pattern" => "/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/",
				"message" => "La fecha de vencimiento no es válida",
			]
		)
		]);
		$this->add($vencimiento);

	}
}
