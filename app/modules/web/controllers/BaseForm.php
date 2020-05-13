<?php

namespace Easyanuncios\Modules\Web\Controllers;

use Phalcon\Forms\Form;

class BaseForm extends Form
{
	public function initialize()
	{
		// Set the same form as entity
		$this->setEntity($this);
	}

	public function messages($name)
	{
		if ($this->hasMessagesFor($name)) {
			//$this->flash->error($this->getMessagesFor($name)[0]);
			foreach ($this->getMessagesFor($name) as $message) {
				$this->flash->error($message);
			}
		}
	}
}
