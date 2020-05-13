
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Celular</th>
			<th>Mensaje</th>
			<th>Correo</th>
			<th>Agente</th>
			<th>Fecha de envío</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for contacto in contactos %}
		<tr>
			<td>{{contacto.nombre}}</td>
			<td>{{contacto.apellido}}</td>
			<td>{{contacto.celular}}</td>
			<td>{{contacto.mensaje}}</td>
			<td>{{contacto.correo}}</td>
			<td>{{contacto.agente}}</td>
			<td>{{contacto.fecha_creacion}}</td>
			<td>

				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "contactos",
						"action" : "eliminar",
						"params" : contacto.id
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
