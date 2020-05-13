<?php

namespace Easyanuncios\Modules\Control\Controllers;
use Easyanuncios\Models\Soporte;
use Easyanuncios\Models\Clientes;

class SoporteController extends ControllerBase
{

	public function initialize()
	{
		parent::initialize();
		$this->view->titulo = "Soporte";
		$this->view->activo = "soporte";
	} 

	public function indexAction()
	{
		$this->assets->addJs("js/jquery-3.4.1.min.js");
		$this->assets->addJs("js/soporte_admin.js"); 
	}
	public function ticketAction($ticket)
	{
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs("js/jquery-3.4.1.min.js");
		$footerCollection->addJs("js/soporte_admin.js");
		//$footerCollection->addJs("js/sweetalert2.js");
		
		$soporte = Soporte::findByNumero($ticket)->toArray()[0]; 
		$params = array();
		$item = array();	 
		$item["numero"] = $soporte['numero'];
		$item["asunto"] = $soporte['asunto'];
		$item["mensaje"] = $soporte['mensaje'];
		$item["usuario"] = Clientes::findById($soporte['usuario'])->toArray()[0]['alias'];
		
		$nombre = Clientes::findById($soporte['usuario'])->toArray()[0]['nombre'];
		$nombre.= ' '.Clientes::findById($soporte['usuario'])->toArray()[0]['apellido'];
		
		$item["usuario_nombre"] = $nombre;
		
		$item["fecha"] = date("d/m/Y h:m a", strtotime($soporte['fecha']));

		$params['soporte'] = $item;
			
		$this->view->setVars($params);
	}
	public function responderAction(){
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		
		$numero = $_POST["numero"];
		$respuesta = $_POST["respuesta"];
		
		$soporte = new Soporte();
		$soporte->mensaje = $respuesta;
		$soporte->usuario = 1;
		$soporte->tipo_usuario = 1;
		$soporte->ticket_respuesta = $this->getIDByNumero($numero);
		$soporte->create();
		$soporte->refresh();
		$parent_soporte = Soporte::findFirstByNumero($numero);
		$parent_soporte->ticket_respuesta = $soporte->id;
		$parent_soporte->update();
	      
		$params = array();
		$params["status"] = 'OK';
		echo json_encode($params);
	}
	private function getIDByNumero($num)
	{
		return Soporte::findByNumero($num)->toArray()[0]['id'];
	}
	public function ticketmsgAction()
	{
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		$params = array();
		$items = array();
		//$soportes = Soporte::find([ 'ticket_respuesta' => $_POST['ticket'] ])->toArray(); 
		
		$soportes = Soporte::findByTicket_respuesta($this->getIDByNumero($_POST['ticket']))->toArray(); 
		
		for($i=0;$i<count($soportes);$i++){
			$item = array();	 
			$item["numero"] = $soportes[$i]['numero'];
			$item["mensaje"] = $soportes[$i]['mensaje'];
			if(intval($soportes[$i]['tipo_usuario'])==1){
				$item["usuario"] = "Easy Anuncios";
			}else{
				$item["usuario"] = Clientes::findById($soportes[$i]['usuario'])->toArray()[0]['alias'];
			}
			$item["fecha"] = date("d/m/Y h:i A", strtotime($soportes[$i]['fecha']));
			array_push($items, $item);
		}
		$params["mensajes"] = $items;
		$params["status"] = 'OK';
		echo json_encode($params);
	}
	public function listAction()
	{
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		$params = array();
		$items = array(); 
		$soportes = Soporte::find([
			'numero IS NOT NULL',
			'order' => 'fecha DESC'
		])->toArray(); 
		for($i=0;$i<count($soportes);$i++){
			$item = array();	 
			$item["nro_ticket"] = $soportes[$i]['numero'];
			$item["asunto"] = $soportes[$i]['asunto'];
			$item["usuario"] = Clientes::findById($soportes[$i]['usuario'])->toArray()[0]['alias'];
			$item["fecha"] = date("d/m/Y h:m a", strtotime($soportes[$i]['fecha']));
			array_push($items, $item);
		}
		$params["soporte"] = $items;
		echo json_encode($params);
	}

}
