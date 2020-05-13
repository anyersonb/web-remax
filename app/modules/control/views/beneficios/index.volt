
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Titulo</th>
			<th>Imagen</th>
			<th>Editar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for beneficio in beneficios %}
		<tr>
			<td>{{beneficio.titulo}}</td>
			<td>
				{{image(
					"system/beneficios/imagen/" ~  beneficio.id,
					"class": "image is-128x128"
				)}}
			</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "beneficios",
						"action" : "editar",
						"params" : beneficio.id
					],
					"title":"Editar",
					"text":"Editar",
					"class":"button is-small"
				])}}

				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "beneficios",
						"action" : "eliminar",
						"params" : beneficio.id
					],
					"title":"Eliminar",
					"text":"Eliminar",
					"class":"button is-small"
				])}}
			</td>
		</tr>
	{% endfor %}
	</tbody>
</table>

{# "action":"control/anuncios/ver/" ~ cliente.id, #}
