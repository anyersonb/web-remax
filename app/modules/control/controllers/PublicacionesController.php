<?php

namespace Easyanuncios\Modules\Control\Controllers;

use Easyanuncios\Models\Publicaciones;
use Easyanuncios\Models\Campagnas;


class PublicacionesController extends ControllerBase
{

	public function indexAction()
	{
		$this->view->disable();
		$p = new Publicaciones();
		$p->id = 1;
		$metaData = $p->getModelsMetaData();


		$attributes = $metaData->getAttributes(
			$p
		);

		//$c = new Campagnas();

		var_dump( $attributes );

		var_dump(
			$metaData->getDataTypes(
				$p
			)
		);
		var_dump($p->toArray());
	}

	public function difusionesAction($id)
	{
		//$publicacion = Publicaciones::findFirstById($id);
		$this->view->disable();
		# $this->response->setContentType("text/plain");
		$fb = $this->fbHelper;

		//$cliente = $this->session->get('cliente');
		//var_dump($cliente);

		// var_dump( get_class($this->fbHelper->cuenta));
		// var_dump( get_class($this->fbHelper->api));
		// var_dump( $fb->obtenerCampaña($id)->toArray());
		// $fb->obtenerCampañas();
		// var_dump( $fb->publicarAnuncio(1));

		// var_dump( $fb->obtenerCampañas());

		// 23843634535580695
		// 120330000013978504
		// $fb->obtenerConjuntos("120330000013978504");
		// $fb->obtenerConjuntos("23843664635930695");
		// $fb->obtenerConjuntos("120330000014957104");

		// var_dump($fb->obtenerConjuntos("23843664635930695", true));
		// var_dump($fb->obtenerConjunto("120330000013993704", true));

		//var_dump($fb->obtenerAnuncios("120330000013993704", true));
		var_dump($fb->obtenerAnuncios("23843664635950695", true));

		//$metaData = new \Phalcon\Mvc\Model\MetaData\Memory();


	}

}
