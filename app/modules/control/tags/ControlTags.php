<?php

namespace Easyanuncios\Modules\Control\Tags;
use Phalcon\Tag;


class ControlTags extends Tag
{

	public function menuItem($item, $clases = [])
	{
		//var_dump($this);
		if (is_array($item)) $item = (object)$item;
		$tag = "";

		$contenido = $this->featherIcon($item->icono, ["is-small"]);
		$contenido .= "&nbsp;";
		$contenido .= self::tagHtml("span", [ "class" => "is-size-6" ]);
		$contenido .= ucwords($item->titulo);
		$contenido .= self::tagHtmlClose("span");

		$ruta = [
			"for" => "controlControllerAction",
			"controller" => $item->controlador,
			"action" => $item->accion
		];

		$clases[] = "item";

		$tag = self::linkTo([
			$ruta,
			"class"=>join(" ", $clases),
			"text" => $contenido
		]);

		return $tag;
	}

	public function featherIcon($icono, $clases = [])
	{
		$clases = @($clases?:[]);
		$clases[] = "icon";

		$tag = "";
		$tag .= self::tagHtml("span", [
				"class" => join(" ", $clases)
			]);
		$tag .= self::tagHtml("i", [
				"data-feather" => $icono
			]);
		$tag .= self::tagHtmlClose("i");
		$tag .= self::tagHtmlClose("span");

		return $tag;

	}

	public function botonOperacion($objeto)
	{
		if (is_array($objeto)) $objeto = (object)$objeto;
		$objeto->clases =  @(isset($objeto->clases)?$objeto->clases:[]);
		$objeto->clases[] = "operacion button";

		return $this->enlace($objeto);

	}

	public function enlace($objeto)
	{
		if (is_array($objeto)) $objeto = (object)$objeto;
		$clases = join(" ", @(isset($objeto->clases)?$objeto->clases:[]));
		$contenido = "";

		if (isset($objeto->icono)) {
			$contenido .= $this->featherIcon($objeto->icono, @(isset($objeto->iconoClases)?$objeto->iconoClases:[]));
		}

		$contenido .= self::tagHtml("span");
		$contenido .= ucwords($objeto->titulo);
		$contenido .= self::tagHtmlClose("span");

		$tag = self::linkTo([
			$objeto->ruta,
			"class"=> $clases,
			"text" => $contenido
		]);


		return $tag;

	}

	public function enlaceRuta($objeto)
	{
		if (is_array($objeto)) $objeto = (object)$objeto;

		$objeto->clases = @($objeto->clases?:[]);
		$objeto->clases[] = "nodo";

		return $this->enlace($objeto);

	}


}
