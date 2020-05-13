<?php

namespace Easyanuncios\Modules\Admin\Controllers;

use Easyanuncios\Models\Clientes;
use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Facturas;
use Easyanuncios\Models\Campagnas;
use Easyanuncios\Models\Difusiones;
use Easyanuncios\Models\Ubigeo;
use Easyanuncios\Modules\Admin\Forms\PagoForm as Pago;

use Phalcon\Filter;
use Phalcon\Image\Factory;
use Nette\Utils\Image;

class crearController extends ControllerBase
{
	public function onConstruct()
	{
		parent::onConstruct();

		$this->assets->addCss("css/admin-crear.css");
		$this->view->titulo = "Crea tu anuncio";
	}


	public function indexAction()
	{
		$this->response->redirect([
			"for"			=> "adminControllerAction",
			"controller"	=> "crear",
			'action'		=> 'elige',
		]);

	}

	public function eligeAction()
	{
		if ( $this->request->isPost() ) {
			$anuncio["tipo"] = $this->request->getPost("tipo");
			$this->session->set('anuncio', $anuncio);

			$this->response->redirect([
				"for"			=> "adminControllerAction",
				"controller"	=> "crear",
				'action'		=> 'editar',
			]);
		}
		//$this->session->set('anuncio', []);
	}

	public function editarAction()
	{
		$cliente = $this->session->get('cliente');
		$anuncio = $this->session->get('anuncio');

		if ( $this->request->isPost() ) {
			$anuncio["arte"] = $this->request->getPost("arte");
			$anuncio["titulo"]		= $this->request->getPost("titulo");
			$anuncio["descripcion"]	= $this->request->getPost("descripcion");
			$anuncio["enlace"]		= $this->request->getPost("enlace", null, "https://www.facebook.com/EasyAnuncios/")?:"https://www.facebook.com/EasyAnuncios/";
			$anuncio["cliente"]		= $cliente["id"];

			$arte = $this->request->getPost("arte");
			list( $ms, ) = explode( " ", microtime());
			$imagen = date("YmdHis").($ms*1e8).str_pad($cliente["id"],8,"0", STR_PAD_LEFT);

			$re = '/^data:(?<formato>[a-z\/]+);base64,(?<datos>[A-Z0-9a-z+\/]{80,}[=]{0,3})$/su';

			if( preg_match( $re, $arte, $captura ) ){
				list( , $extension ) = explode( "/", $captura["formato"] );
				$carpeta = FILES_PATH . "/imagenes";
				if ( !file_exists( $carpeta )) {
					mkdir( $carpeta );
				}

				$ruta = "$carpeta/$imagen.$extension";
				//file_put_contents($ruta, base64_decode($captura["datos"]));

				$anuncio["imagen"]	= "$imagen.$extension";

				$imagen = Image::fromString(base64_decode($captura["datos"]));

				$imagen->save($ruta);
			}
			else {
				// var_dump($arte);
				// exit();
			}


			if ($anuncio["id"]) {
				$na = Anuncios::findFirst($anuncio["id"]);
			}
			else{
				$na = new Anuncios();
			}

			$na->assign($anuncio);

			if ($na->save()) {
				$na->refresh();
				$anuncio["id"] = $na->id;
				//$anuncio["id"]

				$this->session->set('anuncio', $anuncio);
				if($cliente["agente"]){

					$this->response->redirect([
						"for"			=> "adminControllerAction",
						"controller"	=> "crear",
						'action'		=> 'marca',
					]);
				}
				else{

					$this->response->redirect([
						"for"			=> "adminControllerAction",
						"controller"	=> "crear",
						'action'		=> 'inversion',
					]);
				}
			}
			else{
				$mensajes = $na->getMessages();

				foreach ($mensajes as $mensaje) {
					$this->flashsession->error($mensaje);
				}
			}
		}

		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.css', false);

		$headerCollection = $this->assets->collection('header');
		$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.js", false, null, ["async"=>"async"]);

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs('js/admin-crear-editar.js', true, null, ["defer"=>"defer"]);
	}

	public function marcaAction()
	{
		$anuncioId = $this->session->get('anuncio')["id"];
		//$campagnaId = $this->session->get('anuncio')["campaña"];

		if ($this->request->isPost()) {
			$tamagno = $this->request->getPost('tamagno', Filter::FILTER_ABSINT);
			$py = $this->request->getPost('ordenada', Filter::FILTER_ABSINT);
			$px = $this->request->getPost('abscisa', Filter::FILTER_ABSINT);
			$mostrar = $this->request->getPost('mostrar');

			$anuncio = Anuncios::findFirstById($anuncioId);
			$ruta = FILES_PATH . "/imagenes/{$anuncio->imagen}";

			$this->session->set('marca', [
				"mostrar" => $mostrar,
				"tamagno" => $tamagno,
				"ordenada" => $py,
				"abscisa" => $px,
			]);

			//var_dump($anuncio->toArray());
			//var_dump($this->request->getPost());

			if($mostrar == "on"){
				$logo = "globo.png";
				$imagen = Image::fromFile($ruta);
				$marca = Image::fromFile(FILES_PATH . "/marca/$logo");

				$marca->resize(round($imagen->width * $tamagno * 0.01), null);

				$imagen->place($marca, "$px%", "$py%");
			}

			// $imagen = Image::fromString(base64_decode($captura["datos"]));
			$imagen->save($ruta);

			$this->response->redirect([
				"for"			=> "adminControllerAction",
				"controller"	=> "crear",
				'action'		=> 'inversion',
			]);
		}

		$this->view->anuncio = Anuncios::findFirstById($anuncioId);
		$this->view->campagna = Campagnas::findFirstById($campagnaId);

		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.min.css', false);
		$this->assets->addCss('css/admin-crear-marca.css');

		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.1/gsap.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/gsap/3.0.1/Draggable.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs('js/admin-crear-marca.js', true, null, ["defer"=>"defer"]);

	}

	public function inversionAction()
	{
		if ( $this->request->isPost() ) {
			$anuncio = $this->session->get('anuncio');

			$datos = $this->request->getPost();
			//var_dump($datos);

			$departamento = $this->request->getPost("departamento","string", "00");
			$provincia =  $this->request->getPost("provincia","string", "00");
			$distrito = $this->request->getPost("distrito","string", "00");

			$ubigeo = "$departamento$provincia$distrito";

			$datos["anuncio"] = $anuncio["id"];
			$anuncioActual = Anuncios::findFirst($anuncio["id"]);
			$anuncioActual->genero = $datos["genero"];
			$edad = json_decode($datos["edad"]);
			$anuncioActual->edadMinima = (int)$edad[0];
			$anuncioActual->edadMaxima = (int)$edad[1];
			$anuncioActual->lugar = $datos["lugares"];
			$anuncioActual->ubigeo = $ubigeo;
			$anuncioActual->save();
			$this->session->set('datos', $datos);

			//$datos["edad"] = $edad;
			$this->session->set('inversion', $datos);

			$campaña = new Campagnas();
			$campaña->assign($datos);
			if ($campaña->create()) {
				$campaña->refresh();
				$anuncio["campaña"] = $campaña->id;

				$this->session->set('anuncio', $anuncio);
				$this->response->redirect([
					"for"			=> "adminControllerAction",
					"controller"	=> "crear",
					'action'		=> 'factura',
				]);

			}else{
				$mensajes = $campaña->getMessages();

				foreach ($mensajes as $mensaje) {
					$this->flashsession->error($mensaje);
				}
			}
		}

		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.min.css', false);
		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/flatpickr.min.css', false);
		$this->assets->addCss('https://rawcdn.githack.com/yairEO/tagify/75b6a68211e4f70d9fd23730e61b3cd549b13471/dist/tagify.css', false);
		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css', false);
		// $this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/css/tether.min.css', false);
		// $this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/css/tether.css', false);
		// $this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/css/tether-theme-basic.css', false);
		//$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/choices.js/3.0.4/styles/css/choices.css', false);

		// $headerCollection = $this->assets->collection('header');
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://rawcdn.githack.com/jccazeaux/scriber/6e01c949b9a704c60088760cf08f2e9bdd32be47/dist/scriber.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/flatpickr.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/l10n/es.js", false, null, ["async"=>"async"]);
		// $this->assets->addJs("https://rawcdn.githack.com/yairEO/tagify/75b6a68211e4f70d9fd23730e61b3cd549b13471/dist/tagify.polyfills.min.js", false, null, ["async"=>"async"]);
		// $this->assets->addJs("https://rawcdn.githack.com/yairEO/tagify/75b6a68211e4f70d9fd23730e61b3cd549b13471/dist/tagify.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/taggle/1.14.4/taggle.min.js", false, null, ["async"=>"async"]);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js", false, null);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.js", false, null);
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js", false, null);
		//$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/choices.js/3.0.4/choices.min.js", false, null, ["async"=>"async"]);

		$this->view->lugares = $this->lugares();
		$this->view->departamentos = Ubigeo::departamentos();


		//$footerCollection = $this->assets->collection('footer');
		$api = $this->url->get("system/api/");
		$this->assets->addInlineJs("const API = '$api';");
		$this->assets->addJs('js/admin-crear-inversion.js', true, null, ["defer"=>"defer"]);
	}

	public function facturaAction()
	{
		$anuncioId = $this->session->get('anuncio')["id"];
		$campagnaId = $this->session->get('anuncio')["campaña"];

		$this->view->anuncio = Anuncios::findFirstById($anuncioId);
		$this->view->campagna = Campagnas::findFirstById($campagnaId);
	}

	public function pagarAction()
	{
		$campagnaId = $this->session->get('anuncio')["campaña"];
		//$campagna = Campagnas::findFirst($campagnaId);
		$factura = Facturas::generar($campagnaId);
		$pago = $this->paypalHelper->cobrar($factura);
		//var_dump($pago);
		//exit();
		$this->response->redirect($pago->getApprovalLink());
	}



	public function pagoAction()
	{
		//var_dump($this->request->getQuery());
		$request = $this->request;

		if ($request->get("estado") == "pagado") {
			//$pago = $this->paypalHelper->getPago($request->get("paymentId"));

			$pago = $this->paypalHelper->completar($request->get("paymentId"), $request->get("PayerID"));
			//var_dump($pago);
			//var_dump($pago->getState());
			//var_dump($pago->getTransactions());
			if( $pago->getState() == "approved" ){
				$transacciones = $pago->getTransactions();
				$transaccion = $transacciones[0];
				$factura = Facturas::findFirstByCodigo($transaccion->getInvoiceNumber());

				$factura->estado = Facturas::PAGADO;
				$factura->pago =$pago->getId();

				$factura->Campagna->estado = Campagnas::PAGADA;
				$factura->save();
				//$this->view->factura = $factura;

				$this->response->redirect([
					"for"			=> "adminControllerAction",
					"controller"	=> "crear",
					'action'		=> 'publicar',
				]);

			}

			//exit();
		}else{
			$this->response->redirect([
					"for"			=> "adminControllerAction",
					"controller"	=> "crear",
					'action'		=> 'factura',
				]);
		}

		//$this->response->redirect($pago->getApprovalLink());
	}

	public function publicarAction()
	{
		/* ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
		error_reporting(E_ERROR ); */

		$this->assets->addJs("js/admin-crear-publicar.js");

		$campagnaId = $this->session->get('anuncio')["campaña"];
		$this->view->id = $campagnaId;
		$this->view->ficha = $this->crypt->encryptBase64($campagnaId, null, true);
		//var_dump($this->session->get('anuncio'));
		//return;
		/*
		$difusion = $this->fbHelper->publicarAnuncio($campagnaId);
		//$difusion = Difusiones::findFirst(5);
		//print( $r );
		if (isset($difusion->error)) {
			$mensaje = $difusion->error->getErrorUserMessage()?:$difusion->error->getMessage();
			$this->flashsession->notice($mensaje);
		}
		else{
			$this->flashsession->success("Anuncio publicado exitosamente. Los resultados del anuncio se podrán ver en la página STATUS próximamente");
			$this->view->difusion = $difusion;
			$this->view->datos = (object)$this->fbHelper->obtenerAnuncio($difusion->codigo)->getData();
			$previo = $this->fbHelper->obtenerPrevio($difusion->codigo);
			$dom = new \DOMDocument;
			$dom->loadHTML($previo->body);
			$iframe = $dom->getElementsByTagName('iframe');
			$iframe[0]->removeAttribute('width');
			$iframe[0]->removeAttribute('height');
			$iframe[0]->setAttribute('scrolling', "no");
			$iframe[0]->setAttribute('id', "previo");
			$this->view->previo = $dom->saveHTML();
		}
		*/
	}

	public function lugares()
	{
		return [
			"Lima" => "Lima",
			"Ancon" => "Ancon",
			"Vitarte" => "Vitarte",
			"Barranco" => "Barranco",
			"Breqa" => "Breqa",
			"Carabayllo" => "Carabayllo",
			"Chaclacayo" => "Chaclacayo",
			"Chorrillos" => "Chorrillos",
			"Cieneguilla" => "Cieneguilla",
			"La Libertad" => "La Libertad",
			"El Agustino" => "El Agustino",
			"Independencia" => "Independencia",
			"Jesus Maria" => "Jesus Maria",
			"La Molina" => "La Molina",
			"La Victoria" => "La Victoria",
			"Lince" => "Lince",
			"Las Palmeras" => "Las Palmeras",
			"Chosica" => "Chosica",
			"Lurin" => "Lurin",
			"Magdalena del Mar" => "Magdalena del Mar",
			"Pueblo Libre" => "Pueblo Libre",
			"Miraflores" => "Miraflores",
			"Pachacamac" => "Pachacamac",
			"Pucusana" => "Pucusana",
			"Puente Piedra" => "Puente Piedra",
			"Punta Hermosa" => "Punta Hermosa",
			"Punta Negra" => "Punta Negra",
			"Rimac" => "Rimac",
			"San Bartolo" => "San Bartolo",
			"San Francisco de Borja" => "San Francisco de Borja",
			"San Isidro" => "San Isidro",
			"San Juan de Lurigancho" => "San Juan de Lurigancho",
			"Ciudad de Dios" => "Ciudad de Dios",
			"San Luis" => "San Luis",
			"Barrio Obrero Industrial" => "Barrio Obrero Industrial",
			"San Miguel" => "San Miguel",
			"Santa Anita" => "Santa Anita",
			"Santa Maria del Mar" => "Santa Maria del Mar",
			"Santa Rosa" => "Santa Rosa",
			"Santiago de Surco" => "Santiago de Surco",
			"Surquillo" => "Surquillo",
			"Villa El Salvador" => "Villa El Salvador",
			"Villa Maria del Triunfo" => "Villa Maria del Triunfo",
			"Bagua" => "Bagua",
			"Huaraz" => "Huaraz",
			"Abancay" => "Abancay",
			"Arequipa" => "Arequipa",
			"Ayacucho" => "Ayacucho",
			"Cajamarca" => "Cajamarca",
			"Callao" => "Callao",
			"Cusco" => "Cusco",
			"Huancavelica" => "Huancavelica",
			"Huanuco" => "Huanuco",
			"Ica" => "Ica",
			"Huancayo" => "Huancayo",
			"Trujillo" => "Trujillo",
			"Chiclayo" => "Chiclayo",
			"Lima" => "Lima",
			"Iquitos" => "Iquitos",
			"Puerto Maldonado" => "Puerto Maldonado",
			"Moquegua" => "Moquegua",
			"Cerro de Pasco" => "Cerro de Pasco",
			"Piura" => "Piura",
			"Puno" => "Puno",
			"Moyobamba" => "Moyobamba",
			"Tacna" => "Tacna",
			"Tumbes" => "Tumbes",
			"Pucallpa" => "Pucallpa",
		];
	}
}
