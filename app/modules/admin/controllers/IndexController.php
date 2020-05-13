<?php

namespace Easyanuncios\Modules\Admin\Controllers;

use Easyanuncios\Models\Anuncios;
use Easyanuncios\Models\Campagnas;

class IndexController extends ControllerBase
{
	public function indexAction(){

		$this->response->redirect(
			[
				"for"			=> "adminController",
				"controller"	=> "diseños"
			]
		);
	}

	public function crearAction(string $fase = "elige"){
		$this->assets->addCss('css/admin-index-editar.css');
		if ( $this->request->isPost() ) {
			if ($this->session->has('anuncio')) {
				$anuncio = $this->session->get('anuncio');
			}else{
				$anuncio = array();
			}

			switch ( $fase ){
				case 'elige':
						$anuncio["tipo"] = $this->request->getPost("tipo");
						$this->session->set('anuncio', $anuncio);

						$this->response->redirect(
							[
								"for"			=> "adminControllerAction",
								"controller"	=> "index",
								'action'		=> 'crear',
								'params'		=> 'editar',
							]
						);

						// return $this->dispatcher->forward(
						// 	[
						// 		'controller'	=> 'index',
						// 		'action'		=> 'crear',
						// 		'params'		=> ['editar'],
						// 	]
						// );
					break;
				case 'editar':
						$cliente = $this->session->get('cliente');
						$anuncio = $this->session->get('anuncio');
						// $anuncio["arte"] = $this->request->getPost("arte");
						$anuncio["arte"]		= $this->request->getPost("arte");
						$anuncio["titulo"]		= $this->request->getPost("titulo");
						$anuncio["descripcion"]	= $this->request->getPost("descripcion");
						$anuncio["enlace"]		= $this->request->getPost("enlace");
						$anuncio["cliente"]		= $cliente["id"];
						//
						list( $ms, ) = explode( " ", microtime());
						$imagen = date("YmdHis").($ms*1e8).str_pad($cliente["id"],8,"0", STR_PAD_LEFT);

						$re = '/^data:(?<formato>[a-z\/]+);base64,(?<datos>[A-Z0-9a-z+\/]{80,}[=]{0,3})$/su';

						if( preg_match( $re, $anuncio["arte"], $captura ) ){
							list( , $extension ) = explode( "/", $captura["formato"] );
							$carpeta = FILES_PATH . "/imagenes";
							if ( !file_exists( $carpeta )) {
								mkdir( $carpeta );
							}

							$ruta = "$carpeta/$imagen.$extension";
							file_put_contents($ruta, base64_decode($captura["datos"]));

							$anuncio["imagen"]	= "$imagen.$extension";
						}

						$na = new Anuncios();
						$na->assign($anuncio);

						if ($na->create()) {
							$na->refresh();
							$anuncio["id"] = $na->id;

							$this->session->set('anuncio', $anuncio);
							$this->response->redirect(
								[
									"for"			=> "adminControllerAction",
									"controller"	=> "index",
									'action'		=> 'crear',
									'params'		=> 'inversion',
								]
							);
						}
						else{
							$mensajes = $na->getMessages();

							foreach ($mensajes as $mensaje) {
								$this->flashsession->error($mensaje);
							}
						}

					break;
				case 'inversion':
						$anuncio = $this->session->get('anuncio');

						$datos =  $this->request->getPost();
						$datos["anuncio"] = $anuncio["id"];

						$campaña = new Campagnas();
						$campaña->assign($datos);
						if ($campaña->create()) {
							$campaña->refresh();
							$anuncio["campaña"] = $campaña->id;

							$this->session->set('anuncio', $anuncio);

							$this->response->redirect(
								[
									"for"			=> "adminControllerAction",
									"controller"	=> "index",
									'action'		=> 'crear',
									'params'		=> 'pago',
								]
							);

						}else{
							$mensajes = $campaña->getMessages();

							foreach ($mensajes as $mensaje) {
								$this->flashsession->error($mensaje);
							}
						}

						$this->response->redirect(
								[
									"for"			=> "adminControllerAction",
									"controller"	=> "index",
									'action'		=> 'crear',
									'params'		=> 'factura',
								]
							);

					break;
				default:
					# code...
					break;
			}

		}
		else{
			switch ( $fase ){
				case 'elige':
					$this->session->set('anuncio', []);
				break;

				case 'editar':
					$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.css', false);

					$headerCollection = $this->assets->collection('header');
					$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.js", false, null, ["async"=>"async"]);

					$footerCollection = $this->assets->collection('footer');
					$footerCollection->addJs('js/admin-index-crear-editar.js', true, null, ["defer"=>"defer"]);
				break;
				case 'inversion':
					$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.min.css', false);
					$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/flatpickr.min.css', false);

					$headerCollection = $this->assets->collection('header');
					$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.2/nouislider.min.js", false, null, ["async"=>"async"]);
					$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.1.0/wNumb.min.js", false, null, ["async"=>"async"]);
					$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js", false, null, ["async"=>"async"]);
					$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/flatpickr.min.js", false, null, ["async"=>"async"]);
					$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/l10n/es.js", false, null, ["async"=>"async"]);

					$footerCollection = $this->assets->collection('footer');
					$footerCollection->addJs('js/admin-index-crear-inversion.js', true, null, ["defer"=>"defer"]);
				break;
				case 'factura':
					$anuncioId = $this->session->get('anuncio')["id"];
					$campagnaId = $this->session->get('anuncio')["campaña"];
					$this->view->anuncio = Anuncios::findFirstById($anuncioId);
					$this->view->campagna = Campagnas::findFirstById($campagnaId);

				break;

				default:
					# code...
					break;
			}

			$this->view->titulo = "Crea tu anuncio";

			$this->view->pick("index/crear-$fase");
		}



	}

	public function facturasAction(){
		$cliente = $this->session->get('cliente');
		//$this->view->anuncios = Anuncios::findByCliente($cliente["id"]);
		$this->view->anuncios = Anuncios::find([
			"cliente = '?cliente'",
			"bind" => [
				"cliente" => 14
			],
			'order' => 'creacion DESC',
			'limit' => 50,
		]);

		$this->view->titulo = "Facturas";
	}
}
