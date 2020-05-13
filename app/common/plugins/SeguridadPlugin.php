<?php

namespace Easyanuncios\Plugins;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Acl\Adapter\Memory as AclList;

class SeguridadPlugin extends Plugin
{

	public function obtenerAcl(){
		if (!isset($this->persistent->acl)) {
			$acl = new AclList();
			$acl->setDefaultAction(Acl::DENY);
			$roles = [
				'Visitante' => new Role('Visitante'),
				'Cliente' => new Role('Cliente')
			];
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			$internos = [
				'index' => ["*"]
			];
			foreach ($internos as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			$externos = [
				'clientes' => ['registro', "login", "salir", "recuperar", "restablecer"]
			];
			foreach ($externos as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}

			foreach ($roles as $role) {
				foreach ($externos as $resource => $actions) {
					$acl->allow($role->getName(), $resource, '*');
				}
			}

			foreach ($internos as $resource => $actions) {
				foreach ($actions as $action) {
					$acl->allow("Cliente", $resource, $action);
				}
			}


			$this->persistent->acl = $acl;

		}

		return $this->persistent->acl;
	}

	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
	{

		$cliente = $this->session->get('cliente');
		if ($cliente){
			$rol = 'Cliente';
		} else {
			$rol = 'Visitante';
		}
		//var_dump($rol);

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		/* Debugbar start */
		$ns = $dispatcher->getNamespaceName();
		if ($ns=='Snowair\Debugbar\Controllers') {
			return true;
		}
		/* Debugbar end */

		$acl = $this->obtenerAcl();

		// var_dump($controller);
		// var_dump($acl);
		// exit();


		if (!$acl->isResource($controller)) {
			$dispatcher->forward([
				'controller' => 'clientes',
				'action'     => 'login'
			]);
			return false;
		}

		$permitido = $acl->isAllowed($rol, $controller, $action);
		// var_dump($controller);
		// var_dump($action);
		// var_dump($permitido);
		// exit();
		if (!$permitido) {
			$dispatcher->forward([
				'controller' => 'clientes',
				'action'     => 'login'
			]);
			$this->session->destroy();
			return false;
		}
	}
}
