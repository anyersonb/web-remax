<?php

namespace Easyanuncios\Modules\System\Controllers;

use Phalcon\Image\Factory;
use Easyanuncios\Models\Anuncios;

class AnunciosController extends ControllerBase
{

	public function indexAction()
	{
		$imagen = $this->webHelper->url([
				"for"			=> "systemControllerAction",
				"controller"	=> "anuncios",
				'action'		=> 'imagen',
				'params'		=> 1,
			]);

		print_r($this->request->getServer("HTTP_HOST"));
		echo "<br>";
		print_r($imagen);
		echo "<br>";
		$ruta = "/control/uno";
		print_r($this->url->get($ruta));
		echo "<br>";
	}

	public function imagenAction(int $id, string $tamagno = null)
	{
		$anuncio = Anuncios::findFirstById($id);
		// var_dump( $anuncio->toArray() );
		// var_dump( new \dateTime($anuncio->modificacion) );
		// exit();

		if ( $anuncio ) {
			$cacheKey = "img.anuncio.$id.$tamagno";
			$img = $this->cache->get($cacheKey);
			if ( $img == null ) {
				$ruta = FILES_PATH . "/imagenes/{$anuncio->imagen}";

				//$this->response->setContentType( \mime_content_type ($ruta) );
				//$this->response->setContentType( "image/png" );
				//$this->response->setContentType( "text/plain" );

				if (!file_exists($ruta)) {
					$img = base64_decode("iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=");
				}
				elseif (isset($tamagno)) {
					$imagen = Factory::load([
						"file"	=> $ruta,
						"adapter" => $this->config->imagen->adapter
					]);

					$imagen->resize(
						$tamagno,
						null,
						\Phalcon\Image::WIDTH
					);
					$img = $imagen->render();
				}else{
					$img = file_get_contents( $ruta );

				}

				if( AMBIENTE != "desarrollo" ){
					$this->cache->save($cacheKey, $img);
				}
			}

			//$this->response->setContentType( \mime_content_type ($ruta) );
			$this->response->setContentType("image/png");
			$this->response->setExpires(new \dateTime('+50 years'));
			$this->response->setLastModified(new \dateTime($anuncio->modificacion));
			$this->response->setContent( $img );

			return $this->response->send();

		}
		else{
			$this->response->setContentType("image/gif");
			$this->response->setContent( base64_decode("R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==") );

			return $this->response->send();
		}

	}

	public function infoAction(int $id)
	{

		$fb = $this->fbHelper;

		//$cliente = $this->session->get('cliente');
		//var_dump($cliente);

		// var_dump( get_class($this->fbHelper->cuenta));
		// var_dump( get_class($this->fbHelper->api));
		// var_dump( $fb->obtenerCampaña(1)->toArray());
		//$fb->obtenerCampañas();
		//var_dump( $fb->publicarAnuncio(1));
		$fb->publicarAnuncio(1);

		//var_dump( $fb->obtenerCampañas());

		// 23843634535580695
		# $fb->obtenerConjuntos("2384363453558069");
		//$fb->obtenerConjuntos("23843634535580695");
	}

	public function publicar(int $id)
	{
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
		error_reporting(E_ERROR );
		$fb = $this->fbHelper;
		$r = $fb->publicarAnuncio($id);

		//var_dump( get_class($r) );
		//var_dump( $r->error->getMessage() );
		//var_dump( $r->error->getUserMessage() );
		print_r($r->error->getErrorUserMessage());

	}

	public function publicarAction(string $ficha)
	{
		//$this->response->setContentType( "text/html" );
		$id = $this->crypt->decryptBase64($ficha, null, true);
		$difusion = $this->fbHelper->publicarAnuncio($id);
		//$difusion = Difusiones::findFirst(5);
		//print( $r );
		$resultado = [];
		if (isset($difusion->error)) {
			$mensaje = $difusion->error->getErrorUserMessage()?:$difusion->error->getMessage();
			//$this->flashsession->notice($mensaje);
			$resultado["ok"] = false;
			$resultado["error"] = $mensaje;
		}
		else{
			//$this->flashsession->success("Anuncio publicado exitosamente. Los resultados del anuncio se podrán ver en la página STATUS próximamente");
			//$this->view->difusion = $difusion;
			//$this->view->datos = (object)$this->fbHelper->obtenerAnuncio($difusion->codigo)->getData();
			$a = $difusion->Anuncio;
			$previo = $this->fbHelper->obtenerPrevio($difusion->codigo);

			$dom = new \DOMDocument;
			$dom->loadHTML($previo->body);
			$iframe = $dom->getElementsByTagName('iframe');
			$iframe[0]->removeAttribute('width');
			$iframe[0]->removeAttribute('height');
			$iframe[0]->setAttribute('scrolling', "no");
			//$iframe[0]->setAttribute('id', "previo");
			//$this->view->previo = $dom->saveHTML();
			$resultado["ok"] = true;
			$resultado["previo"] = $dom->saveHTML();

			$resultado["difusion"]  = $difusion->toArray();
			$resultado["datos"] = (object)$this->fbHelper->obtenerAnuncio($difusion->codigo)->getData();

		}

		$this->response->setContentType( "application/json" );
		$this->response->setContent(json_encode($resultado));
		return $this->response;
	}
}
