<?php

return [
	'application' => [
		'controllersDir' => __DIR__ . '/../controllers/',
		'modelsDir' 	 => __DIR__ . '/../models/',
		'viewsDir'		 => __DIR__ . '/../views/',
		"formsDir"		 => __DIR__ . '/../forms/',
		"pluginsDir"	 => __DIR__ . '/../plugins/',
	],
	"menuLateral" => [
		[
			"ico" => "ico-status.svg",
			"controlador" => "index",
			"accion" => "index",
			"titulo" => "Status",
			"nombre" => "status",
		],[
			"ico" => "ico-crear.svg",
			"controlador" => "crear",
			"accion" => "index",
			"titulo" => "Crear",
			"nombre" => "crear",
		],[
			"ico" => "ico-facturas.svg",
			"controlador" => "resumen",
			"accion" => "index",
			"titulo" => "Resumen",
			"nombre" => "resumen",
		],[
			"ico" => "ico-soporte.svg",
			"controlador" => "datos",
			"accion" => "index",
			"titulo" => "Mis Datos",
			"nombre" => "datos",
		],[
			"ico" => "ico-soporte.svg",
			"controlador" => "soporte",
			"accion" => "index",
			"titulo" => "Soporte",
			"nombre" => "soporte",
		// ],[
		// 	"ico" => "ico-config.svg",
		// 	"controlador" => "index",
		// 	"accion" => "config",
		// 	"titulo" => "Config"
		]
	],
	"permisos" => [
		"visitante" => [
			"usuario" => ["login"]
		],
		"admin" => "*"
	]
];
