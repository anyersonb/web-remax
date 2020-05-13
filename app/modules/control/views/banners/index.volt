
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Titulo</th>
			<th>Imagen</th>
			<th>Editar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for banner in banners %}
		<tr>
			<td>{{banner.nombre}}</td>
			<td>{{banner.titulo}}</td>
			<td>
				{{image(
					"system/banners/imagen/" ~  banner.id,
					"class": "image is-128x128"
				)}}
			</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "banners",
						"action" : "editar",
						"params" : banner.id
					],
					"title":"Editar",
					"text":"Editar",
					"class":"button is-small"
				])}}

				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "banners",
						"action" : "eliminar",
						"params" : banner.id
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
