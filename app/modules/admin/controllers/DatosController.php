<?php

namespace Easyanuncios\Modules\Admin\Controllers;

use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Campagnas;
use Easyanuncios\Models\Soporte;
use Easyanuncios\Models\Clientes;
use Easyanuncios\Modules\Admin\Forms\DatosForm as DatosForm;
class DatosController extends ControllerBase
{

	public function indexAction(){
		$this->view->titulo = "Mis datos";

		$this->assets->addJs("js/jquery-3.4.1.min.js");
		//$this->assets->addJs("js/soporte.js");
		$id_cliente = $this->session->get('cliente')['id'];
		$cliente = Clientes::findFirstById($id_cliente);
		//print_r($cliente>nombre);
		//exit();
		$registro = new DatosForm($cliente);
		if ($this->request->isPost()) {
			//$this->view->disable();
			$datos = $this->request->getPost();
			$registro->bind($datos, $cliente);
			if ($registro->isValid()) {
				if ( $cliente->update() ) {
					$this->flashsession->success("Datos Actualizados");
				}else{
					foreach ( $cliente->getMessages() as $message ) {
						$this->flashsession->error(
							$message->getMessage()
						);
					}
				}

			}
			else{
				foreach ( $registro->getMessages() as $message ) {
					$this->flashsession->error(
						$message->getMessage()
					);
				}
			}

		}

		$headerCollection = $this->assets->collection('header');
		$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/tingle/0.15.1/tingle.min.js", false, null);

		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/tingle/0.15.1/tingle.min.css', false);

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs('js/admin-clientes-registro.js', true, null, ["defer"=>"defer"]);

		$this->view->form = $registro;
	}
	/*
	public function ticketAction($ticket)
	{
		$this->view->titulo = "Ticket ".$ticket;
		//$headerCollection = $this->assets->collection('header');
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js",false);
		$this->assets->addJs("js/soporte.js");
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js",false);

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

		$params['active_response'] = false;

		$this->view->setVars($params);

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

		//soportes = Soporte::findByTicket_respuesta($this->getIDByNumero($_POST['ticket']))->toArray();
		//'order' => 'fecha DESC'

		$soportes = Soporte::find([
			"ticket_respuesta = '".$this->getIDByNumero($_POST['ticket'])."'",
			'order' => 'fecha ASC'
		])->toArray();


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
	public function responderAction(){
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();

		$numero = $_POST["numero"];
		$respuesta = $_POST["respuesta"];

		$soporte = new Soporte();
		$soporte->mensaje = $respuesta;
		$soporte->usuario = $this->session->get('cliente')['id'];
		$soporte->tipo_usuario = 0;
		$soporte->ticket_respuesta = $this->getIDByNumero($numero);
		$soporte->create();
		$soporte->refresh();


		$params = array();
		$params["status"] = 'OK';
		echo json_encode($params);
	}
	public function testAction()
	{
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		echo "test";
	}

	private function createNumTicket($x){
		$max = 6;
		return 'T' .str_pad('', $max - strlen((string) $x), '0', STR_PAD_LEFT) . $x;
	}

	public function createAction()
	{
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		$params = array();
		$params["status"] = "OK";
		$params["asunto"] = $_POST["asunto"];

		$soporte = new Soporte();
		$soporte->asunto = $_POST["asunto"];
		$soporte->mensaje = $_POST["mensaje"];
		//$soporte->numero = $this->createNumTicket();
		$soporte->usuario = $this->session->get('cliente')['id'];

		$soporte->create();
		$soporte->refresh();
		$soporte->numero = $this->createNumTicket($soporte->id);
		$soporte->update();
		//$params["id"] = $soporte->id;

		echo json_encode($params);
	}

	public function listAction()
	{
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		$params = array();
		$items = array();

		$soportes = Soporte::find([
			"usuario = '".$this->session->get('cliente')['id']."' AND numero IS NOT NULL",
			'order' => 'fecha DESC'
		])->toArray();


		for($i=0;$i<count($soportes);$i++){
			$item = array();
			$item["nro_ticket"] = $soportes[$i]['numero'];
			$item["asunto"] = $soportes[$i]['asunto'];
			$item["fecha"] = $soportes[$i]['fecha'];
			array_push($items, $item);
		}
		$params["soporte"] = $items;
		echo json_encode($params);
	}

	*/
}
