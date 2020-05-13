
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Pregunta</th>
			<th>Respuesta</th>
			<th>Editar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for preguntasfrecuente in preguntasfrecuentes %}
		<tr>
			<td>{{preguntasfrecuente.pregunta}}</td>
			<td>{{preguntasfrecuente.respuesta}}</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "preguntasfrecuentes",
						"action" : "editar",
						"params" : preguntasfrecuente.id
					],
					"title":"Editar",
					"text":"Editar",
					"class":"button is-small"
				])}}
				
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "preguntasfrecuentes",
						"action" : "eliminar",
						"params" : preguntasfrecuente.id
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
