<?php

namespace Easyanuncios\Modules\Web\Controllers;

use Easyanuncios\Models\Contenidos;
use Easyanuncios\Models\Preguntasfrecuentes;
use Easyanuncios\Models\Tutoriales;
use Easyanuncios\Models\Banners;
use Easyanuncios\Models\Beneficios;

use Easyanuncios\Models\Contacto;

use Easyanuncios\Modules\Web\Controllers\ContactoForm as ContactoForm;

class IndexController extends ControllerBase
{

	public function onConstruct()
	{
		parent::onConstruct();
	}

	public function indexAction()
	{
		//$video = Contenidos::findFirst(1);
		//$this->view->video = $video->objeto; 
		$this->view->beneficios = Beneficios::find();
		$this->view->banners = Banners::find();
		$this->view->email = Contenidos::findFirstByNombre("email")->objeto;
		$this->view->tutoriales = Tutoriales::find();
		$this->view->preguntasfrecuentes = Preguntasfrecuentes::find();
		
		
		
		$this->assets->addCss('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/css/glide.core.min.css', false);
		$this->assets->addCss('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/css/glide.theme.min.css', false);
		
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('/js/script.js');
	}
	public function tutorialesAction()
	{
		$this->view->tutoriales = Tutoriales::find();
		$this->view->imgurl = "http://rxart.easyanuncios.com/tutoriales";
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('/js/tutoriales.js');
		
	}
	public function preguntasAction()
	{
		
		$this->view->preguntasfrecuentes = Preguntasfrecuentes::find();
		$this->assets->addCss('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/css/glide.core.min.css', false);
		$this->assets->addCss('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/css/glide.theme.min.css', false);
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		
		$footerCollection->addJs('//polyfill.io/v3/polyfill.js?features=es5,es6,es7&flags=gated', false);
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.4.0/smooth-scrollbar.js', false);
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js', false);
		$footerCollection->addJs('/js/tutoriales.js');
	}
	public function politicaAction()
	{
		$this->view->politicas = Contenidos::findFirstByNombre("politicadeprivacidad");

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('/js/tutoriales.js');
	}
	public function terminosAction()
	{
		if(isset($_REQUEST["modal"])){
			$this->view->modal = true;
		}else{
			$this->view->modal = false;
	
		}
		//exit();
		$this->view->tyc = Contenidos::findFirstByNombre("terminosycondiciones");
		
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('/js/tutoriales.js');
	}
	public function nosotrosAction()
	{
		
		$this->view->nosotros1 = Contenidos::findFirstByNombre("nosotros");
		$this->view->nosotros2 = Contenidos::findFirstByNombre("nosotros2");
		$this->view->nosotros_sumilla = Contenidos::findFirstByNombre("nosotros3");

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('/js/tutoriales.js');
	}
	public function contactoAction()
	{
		$contacto = new ContactoForm();
		
		if ($this->request->isPost()) {
			//$this->view->disable();
			//var_dump($this->request->getPost());

			if ($contacto->isValid($this->request->getPost())) {
				
				$correo = $this->request->getPost("correo", "email");
				
				$cliente = new Contacto();
				$cliente->assign($this->request->getPost());

				if ( $cliente->create() ) {
					$this->flashsession->setAutoescape(false);
					$this->flashsession->success(
						"Su mensaje fue enviado con exito." 
					);
					$contacto->clear();
					//$this->flashsession->setFlash('nombre', '');
					$cliente->refresh();
					$contacto->clear();
					$this->view->form = $contacto;
					
					$this->response->redirect('contacto');
					

				}else{
						$m = $cliente->getMessages();
						foreach ( $cliente->getMessages() as $message ) {
							$this->flash->error(
								$message->getMessage()
							);
						}
				}


			}
		}
		
		
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->email = Contenidos::findFirstByNombre("email")->objeto;
		$footerCollection->addJs('//cdnjs.cloudflare.com/ajax/libs/Glide.js/3.3.0/glide.js', false);
		$footerCollection->addJs('/js/tutoriales.js');
		$this->view->form = $contacto;
	}

}
