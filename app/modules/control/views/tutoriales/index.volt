
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Titulo</th>
			<th>Descripcion</th>
			<th>Imagen</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for tutorial in tutoriales %}
		<tr>
			<td>{{tutorial.titulo}}</td>
			<td>{{tutorial.descripcion}}</td>
			<td>
				{{image(
					"system/tutoriales/imagen/" ~  tutorial.id,
					"class": "image is-128x128"
				)}}
			</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "tutoriales",
						"action" : "editar",
						"params" : tutorial.id
					],
					"title":"Editar",
					"text":"Editar",
					"class":"button is-small"
				])}}

				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "tutoriales",
						"action" : "eliminar",
						"params" : tutorial.id
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
