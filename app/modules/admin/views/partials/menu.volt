<ul>
	{% for item in config.menuSuperior %}
		<li>{{ linkTo([
			"action":item.accion,
			"text":'<span>' ~ item.titulo|upper ~ '</span>',
			"class":webHelper.esActivo(item.accion)
		])}}</li>
	{% endfor %}

	<div id="usuario">
		{% if( session.get('cliente') ) %}
			<div class="nombre"><span>bienvenido {{ session.get('cliente')["nombreCompleto"] }}</span></div>
			{{linkTo([ "action":"admin/clientes/salir", "text":image("img/ico-salir.svg", "class":"ico"), "title":"Salir"])}}
		{% else %}
			<li>{{linkTo('admin/', image("img/ico-usuario.svg", "class":"ico"))}}</li>
		{% endif %}
	</div>

</ul>
