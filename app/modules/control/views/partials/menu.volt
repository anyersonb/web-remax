<div class="media">
	<div class="media-left">
		<span class="tag is-info is-large">
			{{session.usuario["nombre"][0]|capitalize}}
		</span>
	</div>
	<div class="media-content">
		<p class="is-size-6 has-text-grey">
			{{session.usuario["nombre"]|capitalize}}
		</p>
		{{
			controlTags.enlace([
				"ruta": [
					"for": "controlControllerAction",
					"controller" : "usuarios",
					"action" : "salir"
				],
				"titulo" : "Salir"
			],
			["is-small is-size-7"])
		}}
	</div>
</div>
<nav class="menu">
	<h3 class="menu-label subtitle is-6">Administración</h3>
	<ul class="menu-list">
		{% for item in config.menuPrincipal %}
			{% set clases = [] %}
			{% if activo | default(".") == item.nombre | default("-") %}
				{% set clases = ["is-active"] %}
			{% endif %}
			<li>{{ controlTags.menuItem(item, clases | default([])) }}</li>
		{% endfor %}
	</ul>

</nav>
