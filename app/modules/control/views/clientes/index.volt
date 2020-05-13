
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Nombre Completo</th>
			<th>Correo Electrónico</th>
			<th>Editar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for cliente in clientes %}
		<tr>
			<td>{{cliente.nombreCompleto}}</td>
			<td>{{cliente.correo}}</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "clientes",
						"action" : "editar",
						"params" : cliente.id
					],
					"title":"editar " ~ cliente.nombreCompleto,
					"text":"Editar",
					"class":"button is-small"
				])}}
			</td>
		</tr>
	{% endfor %}
	</tbody>
</table>

{# "action":"control/anuncios/ver/" ~ cliente.id, #}
