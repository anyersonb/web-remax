<ul>

	{% for item in config.menuSuperior %}
		<li>{{ linkTo([
			"action":item.accion,
			"text":'<span>' ~ item.titulo|upper ~ '</span>',
			"class":webHelper.esActivo(item.accion)
		])}}</li>
	{% endfor %}
	<li>{{linkTo('admin/', image("img/ico-usuario.svg", "class":"ico"))}}</li>
</ul>
