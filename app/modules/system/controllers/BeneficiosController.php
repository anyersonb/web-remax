<?php

namespace Easyanuncios\Modules\System\Controllers;

use Phalcon\Image\Factory;
use Easyanuncios\Models\Beneficios;

class BeneficiosController extends ControllerBase
{

	public function indexAction()
	{

	}

	public function imagenAction(int $id, string $tamagno = null)
	{
		$beneficio = Beneficios::findFirstById($id);
		// var_dump( $anuncio->toArray() );
		// var_dump( new \dateTime($anuncio->modificacion) );
		// exit();

		if ( $beneficio ) {
			$cacheKey = "img.beneficio.$id.$tamagno";
			$img = $this->cache->get($cacheKey);
			if ( $img == null ) {
				$ruta = FILES_PATH . "/imagenes/beneficios/{$beneficio->imagen}";

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
			$this->response->setLastModified(new \dateTime($beneficio->modificacion));
			$this->response->setContent( $img );

			return $this->response->send();

		}
		else{
			$this->response->setContentType("image/gif");
			$this->response->setContent( base64_decode("R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==") );

			return $this->response->send();
		}

	}
}
