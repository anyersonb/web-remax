<?php

namespace Easyanuncios\Models\Behavior;

use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Logger;

use Nette\Utils\FileSystem;

class ImagenModelBehavior extends Behavior implements BehaviorInterface
{
	protected $ruta = null;
	protected $campo = null;
	protected $archivo = null;
	protected $antiguo = null;
	protected $log = null;
	protected $fs = null;
	protected $formatos = ['image/jpeg', 'image/png', 'image/gif'];


	public function notify($eventType, ModelInterface $modelo)
	{
		if (!is_string($eventType)) {
			throw new Exception('Parámetro inválido.');
		}

		// Check if the developer decided to take action here
		if (!$this->mustTakeAction($eventType)) {
			return;
		}

		$opciones = $this->getOptions($eventType);

		if (is_array($options)) {
			$this->logger = $modelo->getDI()->get('logger');
			$this->filesystem = new Filesystem;

			$this->configurarCampo($opciones, $modelo)
				->configurarRuta($opciones)
				->configurarRuta($modelo);
		}
	}

	protected function configurarCampo(array $options,  ModelInterface $model)
	{
		if (!isset($options['campo']) || !is_string($options['campo'])) {
			throw new Exception("Debes especificar el Campo y debe ser un string.");
		}

		$this->campo = $options['campo'];
		$this->antiguo = $model->{$this->campo};

		return $this;
	}

	protected function configurarRuta(array $options)
	{
		if (!isset($options['ruta']) || !is_string($options['ruta'])) {
			throw new Exception("Debes especificar la Ruta y debe ser un string.");
		}

		$carpeta = $options['ruta'];

		if (!file_exists($carpeta)) {
			$this->filesystem->createDir($carpeta);
		}

		$this->ruta = $carpeta;

		return $this;
	}

	protected function procesarCarga(ModelInterface $modelo){
		$request = $modelo->getDI()->getRequest();

		if (true == $request->hasFiles(true)) {
			foreach ($request->getUploadedFiles() as $archivo) {

				if ($archivo->getKey() != $this->campo || !in_array($archivo->getType(), $this->formatos)) {
					continue;
				}

				$nombre = time() . '-' . uniqid() . '.' . strtolower($archivo->getExtension());

				if ($archivo->moveTo(rtrim($this->ruta, '/\\') . DIRECTORY_SEPARATOR . $nombre)) {
					$modelo->writeAttribute($this->imageField, $nombre);
					$this->log->log(Logger::INFO, sprintf(
						'Success upload file %s into %s', $nombre, $this->ruta
					));

					$this->borrar();
				}
			}
		}

		return $this;

	}

	protected function borrar(){
		if ($this->antiguo) {
			$rutaCompleta = rtrim($this->ruta, '/\\') . DIRECTORY_SEPARATOR . $this->antiguo;

			try {
				$this->filesystem->remove($rutaCompleta);
				$this->log->log(Logger::INFO, sprintf('Archivo %s borrado correctamente.', $rutaCompleta));
			} catch(\Exception $e) {
				$this->log->log(Logger::ALERT, sprintf(
					'Error al borrar %s: %s', $rutaCompleta, $e->getMessage()
				));
			}
		}
	}

}