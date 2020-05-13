<?php

return [
	"menuPrincipal" => [
		[
			"icono" => "shopping-bag",
			"controlador" => "clientes",
			"accion" => "index",
			"titulo" => "Clientes",
			"nombre" => "clientes",
		],[
			"icono" => "users",
			"controlador" => "usuarios",
			"accion" => "index",
			"titulo" => "Usuarios",
			"nombre" => "usuarios",
		],[
			"icono" => "shopping-bag",
			"controlador" => "beneficios",
			"accion" => "index",
			"titulo" => "Beneficios",
			"nombre" => "beneficios",
		],[
			"icono" => "shopping-bag",
			"controlador" => "banners",
			"accion" => "index",
			"titulo" => "Banners",
			"nombre" => "banners",
		],[
			"icono" => "shopping-bag",
			"controlador" => "preguntasfrecuentes",
			"accion" => "index",
			"titulo" => "Preguntas Frecuentes",
			"nombre" => "preguntasfrecuentes",
		],[
			"icono" => "shopping-bag",
			"controlador" => "contactos",
			"accion" => "index",
			"titulo" => "Contacto",
			"nombre" => "contacto",
		],[
			"icono" => "shopping-bag",
			"controlador" => "tutoriales",
			"accion" => "index",
			"titulo" => "Tutoriales",
			"nombre" => "tutoriales",
		],[
			"icono" => "shopping-bag",
			"controlador" => "contenido",
			"accion" => "index",
			"titulo" => "Contenido del Sitio",
			"nombre" => "contenido",
		]
	],
	"seguridad" => [
		"entidad" => "usuario",
		"permisos" => [
			"desconocido" => [
				"usuarios" => ["login"]
			],
			"usuario" => "*"
		]
	]
];
