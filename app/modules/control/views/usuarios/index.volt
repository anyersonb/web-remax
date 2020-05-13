<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Nombre</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for usuario in usuarios %}
		<tr>
			<td>{{usuario.nombre|capitalize}}</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "usuarios",
						"action" : "editar",
						"params" : usuario.id
					],
					"text":"Editar",
					"class":"button is-small"
				])}}
			</td>
		</tr>
	{% endfor %}
	</tbody>
</table>
