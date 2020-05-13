<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>RE/MAX Design</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="">
	<meta name="description" content="">
	<meta name="robots" content="all">
	<!--[if lt IE 9]>
	<script src="script/html5shiv.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="http://remaxdesignperu.com/favicon.ico" />
	<link rel="stylesheet" media="screen" href="/fonts/fonts.css">
	<link rel="stylesheet" media="screen" href="/css/style.css">
</head>
<body>
	<div id="header">
		<a href="/"><div id="logo"></div></a>
		<button id="alternar-menu">
			{{image("/img/open-menu.svg", "class":"abrir")}}
			{{image("/img/close.svg", "class":"cerrar")}}
		</button>
		<div id="menu" class="">
			<div class="self">
				<div class="item_menu"><a href="/tutoriales">Tutoriales</a></div>
				<div class="item_menu"><a href="/preguntas">Preguntas Frecuentes</a></div>
				{% if( session.get('cliente') ) %}


				<div class="item_menu"><a href="/admin/diseños/">Tus Diseños</a></div>
				<div class="item_menu"><a href="/admin/diseños/plantillas/">Plantillas</a></div>
				{% endif %}
			</div>
			<div class="user">

				{% if( session.get('cliente') ) %}
				<div class="item_menu nobar nobar_real">
					{{ session.get('cliente')["alias"] }}
					{{linkTo([ "action":"admin/clientes/salir", "text":image("/img/power_button.png", "class":"ico_out"), "title":"Salir"])}}
				</div>
				{% else %}
				<div class="start_here"></div>
				<div class="item_menu nobar"><a href="/admin/clientes/registro">Regístrate</a></div>
				<div class="item_menu nobar" id="btn_login_">
					<a href="/admin/clientes/login">
						<span class="iniciar_sesion_text">Iniciar sesión</span> <img class="iniciar_sesion_img" title="Iniciar sesión" alt="Iniciar sesión" src="/img/user.png" width="20px"/>
					</a>
				</div>
				{% endif %}
			</div>
		</div>
	</div>


	{% if( session.get('cliente') ) %}
			<div class="box_login" id="box_login">
				<input type="text" placeholder="Usuario o Email *"/>
				<div class="password_and_login">
					<input type="password" placeholder="Password *"/>
					<div class="button_login" value="">
						<img src="img/ico_login.png" />
					</div>
				</div>
			</div>
		{% endif %}
