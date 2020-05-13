<div class="menu {{activo}}">
	{% for item in config.menuLateral %}
		{{link_to(
			"action" : "admin/" ~ item.controlador ~ "/" ~ item.accion,
			"text" : image("img/" ~ item.ico) ~ "<span>" ~ item.titulo ~ "</span>",
			"class" : ((activo == item.nombre) ? "activo":"") ~ " " ~ item.nombre
		)}}
	{% endfor %}
</div>
