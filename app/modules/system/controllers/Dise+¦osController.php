<?php

namespace Easyanuncios\Modules\System\Controllers;

use Easyanuncios\Models\Disegnos;


class DiseñosController extends ControllerBase
{

	public function onConstruct(){
		parent::onConstruct();
		$this->response->setContentType("application/json");
	}
	public function indexAction(int $cliente = null)
	{
		if (empty($cliente)) {
			$rpta = Disegnos::find();
		}
		else{
			$rpta = Disegnos::findByCliente($cliente);
		}

		$this->response->setContent(json_encode($rpta));
		return $this->response;
	}

	public function obtenerAction(int $id)
	{
		$rpta = Disegnos::findFirst($id);
		$this->response->setContent(json_encode($rpta));
		return $this->response;
	}

	public function guardarAction(int $id = null)
	{
		$rpta = (Object)[];

		if ($this->request->isPost()) {
			$json = $this->request->getJsonRawBody();
			// $this->response->setContentType("text/plain");
			// $this->response->setContent(print_r($json, true));
			// return $this->response;
			// exit();

			if (empty($id)) {
				$diseño = new Disegnos();
				$diseño->assign((array) $json);
				if($diseño->create()){
					$diseño->refresh();
					$rpta->estado = "OK";
					$rpta->id = $diseño->id;
				}else{
					$rpta->estado = "ERROR";
					$rpta->error  = $diseño->getMessages();
				}
			}else {
				$diseño = Disegnos::findFirst($id);
				$diseño->assign((array) $json);
				if ($diseño->update()) {
					$diseño->refresh();
					$rpta->estado = "OK";
					$rpta->id = $diseño->id;
				} else {
					$rpta->estado = "ERROR";
					$rpta->error  = $diseño->getMessages();
				}
			}

		}

		$this->response->setContent(json_encode($rpta));
		return $this->response;
	}
}
