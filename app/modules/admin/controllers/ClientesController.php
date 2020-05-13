<?php

namespace Easyanuncios\Modules\Admin\Controllers;
use Easyanuncios\Models\Clientes;
use Easyanuncios\Models\Temporales;
use Easyanuncios\Models\Contenidos;
use Easyanuncios\Modules\Admin\Forms\RegistroForm as Registro;
use Easyanuncios\Modules\Admin\Forms\RecuperarForm as Recuperar;

use Phalcon\Security\Random;

class clientesController extends ControllerBase
{
	public function onConstruct()
	{
		parent::onConstruct();

		$this->assets->addCss("css/admin-clientes.css");

		// $footerCollection = $this->assets->collection('footer');
		// $footerCollection->addJs('js/admin-clientes.js');

	}

	public function loginAction()
	{
		if ($this->request->isPost()) {
			$alias = $this->request->getPost('alias');
			$clave = $this->request->getPost('clave');

			//$u = Clientes::findFirstByAlias($alias);
			$usuario = Clientes::validar($alias, $clave);
			//$this->view->disable();
			//var_dump($u);
			/*
			echo $clave;
			echo "<br/>";
			echo $alias;
			echo "<br/>";
			var_dump($u->alias);
			echo "<br/>";
			var_dump($u->clave);
			echo "<br/>";
			echo "sha256 ".hash( "sha256", $clave );
			echo "<br/>";
			var_dump($u->clave == hash( "sha256", $clave ));
			 */
			if ( $usuario ) {

				$this->_registrarSesion($usuario->toArray());

				// $this->flashsession->success(
				// 	'bienvenido ' . $usuario->alias
				// );
				// return $this->dispatcher->forward(
				// 	[
				// 		'controller' => 'index',
				// 		'action'     => 'index',
				// 	]
				// );

				$this->response->redirect([
					"for"			=> "adminController",
					"controller"	=> "diseños",
				]);
			}else{

				$this->flashsession->error(
					'Error al iniciar sesión'
				);
			}
		}

		$this->flashsession->setAutoescape(false);
		$this->assets->addJs("js/login.js");
	}

	private function _registrarSesion($cliente)
	{
		$this->session->set(
			'cliente',
			$cliente
		);
	}


	public function registroAction()
	{
		$registro = new Registro();
		if ($this->request->isPost()) {
			//$this->view->disable();
			//var_dump($this->request->getPost());

			if ($registro->isValid($this->request->getPost())) {
				$alias = $this->request->getPost("alias", "string");
				$clienteAlias = Clientes::countByAlias($alias);
				$correo = $this->request->getPost("correo", "email");
				$clienteCorreo = Clientes::countByCorreo($correo);

				if($clienteAlias){
					$this->flashsession->error("El nombre de usuario ya está registrado");
				}else if($clienteCorreo){
					$this->flashsession->error("El correo ya está registrado");
				}else{
					$cliente = new Clientes();
					$cliente->assign($this->request->getPost());

					if ( $cliente->create() ) {
						$cliente->refresh();

						$this->flashsession->setAutoescape(false);
						$this->flashsession->success(
							"Gracias por registrarte. ya puedes iniciar sesión."
						);

						$mensaje = Contenidos::findFirstByNombre("correoRegistro");

						$message = $this->mailer->createMessage()
							->from("contacto@remaxdesignperu.com","RE/MAX Design")
							->to($cliente->correo, $cliente->nombreCompleto)
							->subject($mensaje->titulo)
							->content($mensaje->objeto);
						// Send message
						$message->send();

						$this->response->redirect([
							"for"			=> "adminControllerAction",
							"controller"	=> "clientes",
							'action'		=> 'login',
						]);
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
		}

		$headerCollection = $this->assets->collection('header');
		$headerCollection->addJs("https://cdnjs.cloudflare.com/ajax/libs/tingle/0.15.1/tingle.min.js", false, null);

		$this->assets->addCss('https://cdnjs.cloudflare.com/ajax/libs/tingle/0.15.1/tingle.min.css', false);

		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs('js/admin-clientes-registro.js?random=2', true, null, ["defer"=>"defer"]);

		$this->view->form = $registro;
	}

	public function disenoAction()
	{
		$this->assets->addCss('css/admin.css', false);
	}
	public function plantillasAction()
	{
		$footerCollection = $this->assets->collection('footer');
		$footerCollection->addJs('js/plantillas.js', true, null, ["defer"=>"defer"]);
	}
	public function papeleraAction()
	{

	}
	public function crearAction()
	{

	}
	public function salirAction()
	{
		$this->session->set(
			'cliente',
			false
		);
		$this->response->redirect("/");
	}

	public function forgotAction()
	{
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();

		$params = array();
		$correo=$_POST['correo'];

		$cliente = Clientes::findFirstByCorreo($correo);

		if ($cliente) {
			$random = new Random();
			$hash = $random->uuid();
			//$hash = $this->security->hash($nuevaclave);
			$temporal = new Temporales();
			$temporal->cliente = $cliente->id;
			$temporal->clave = $hash;
			if ($temporal->save()) {
				$temporal->refresh();

				//$html = 'Haga click en el siguiente enlace para actualizar su contraseña: <br/><a href="http://easyanuncios.com/admin/clientes/cambiar/'.$hash.'">Cambiar contraseña</a>';
				//Alejandra
				$html = 'Hola '.$cliente->nombre.',';
				$html .= '<p>Para cambiar tu contraseña por favor haz click en el siguiente enlace, esto te llevará a una página donde podrás escribir una nueva contraseña y guardarla. Puedes realizar esta acción todas las veces que lo necesites.</p>';
				$html .= '<p>¡Gracias por ser parte de RE/MAX Design!</p>';
				$html .= '<a href="https://remaxdesignperu.com/admin/clientes/cambiar/'.$hash.'">';
				$html .= 'Cambiar mi contraseña ahora.';
				$html .= '</a>';

				$message = $this->mailer->createMessage()
									->from("contacto@remaxdesignperu.com","RE/MAX Design")
									->to($correo, $cliente->nombre)
									->subject("Solicitud de cambio de contraseña")
									->content($html);
								// Send message
				$message->send();

				$params['status'] = 'OK';
			}

		}else{
			$params['status'] = 'NO_SE_ENCONTRO_CLIENTE';
		}




			/*

		*/
		echo json_encode($params);
	}

	public function cambiarAction($clave)
	{

		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js",false);
		$this->assets->addJs("js/cambiar.js");
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js",false);

		//$this->response->setContentType('application/json; charset=utf-8');
		//$this->view->disable();

		$temporal = Temporales::findFirstByClave($clave);
		if ($temporal) {
			$id_cliente = $temporal->cliente;
			$params = array();
			$params['id_cliente'] = $id_cliente;
			$this->view->setVars($params);
		}else{
			$this->view->disable();
		}

	}
	public function cambiarpAction(){
		$this->response->setContentType('application/json; charset=utf-8');
		$this->view->disable();
		$params = array();

		$password = $_POST["password"];
		$id_cliente = $_POST["id_cliente"];

		//$clave = hash( "sha256", $password);

		$cliente = Clientes::findFirstById($id_cliente);
		$cliente->clave = $password;
		$cliente->update();

		$params['status'] = 'OK';
		echo json_encode($params);
	}
	public function recuperarAction()
	{

		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js",false);
		$this->assets->addJs("js/recuperar.js");
		$this->assets->addJs("https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js",false);

		$recuperar = New Recuperar();

		if ($this->request->isPost()) {
			if ($recuperar->isValid($this->request->getPost())) {
				$correo = $this->request->getPost("correo");

				$cliente = Clientes::findFirstByCorreo($correo);

				if ($cliente) {
					//print_r($cliente->Temporales);
					// $t = Temporales::findFirst([
					// 	"cliente = :cliente: AND clave = 'baz'",
					// 	"bind" => [ "cliente" => $cliente->id ]
					// ]);

					$datos = new \stdClass();

					//$datos->clave = $this->config->clave;
					//$ciptex = new Crypt('aes-256-ctr', true);

					$random = new Random();
					$nuevaclave = $random->base64Safe(127);

					$datos->clave = $nuevaclave;
					$datos->token = $this->security->hash($nuevaclave);
					var_dump($datos);

					exit();

					$temporal = new Temporales();
					$temporal->cliente = $cliente->id;
					$temporal->clave = "neoclave";
					$temporal->datos = $datos;



					if ($temporal->save()) {

						$temporal->refresh();
						var_dump($temporal->toArray());
					}else{
						$m = $temporal->getMessages();
						var_dump($m);
					}


					//var_dump($t->getModelsMetaData()->getDataTypes($t));
					//var_dump($t->getModelsMetaData()->getPrimaryKeyAttributes($t));


					//print_r($cliente->Temporales);

					exit();

					//$this->flashsession->notice( 'Se ha enviado un mensaje a tu correo' );

				}
				else{

					$this->flashsession->error( 'El correo ingresado no existe' );
				}

			}

		}


		$this->view->form = $recuperar;
	}
}
