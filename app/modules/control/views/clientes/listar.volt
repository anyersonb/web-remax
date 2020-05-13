
<div class="level has-text-white has-background-dark">
	<div class="level-left">
		<h3 class="level-item is-size-4">Campañas</h3>
	</div>
	<div class="level-right">

	</div>
</div>
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre Completo</th>
			<th>Correo Electrónico</th>
			<th>Anuncios</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for cliente in clientes %}
		<tr>
			<td>{{cliente.id}}</td>
			<td>{{cliente.nombreCompleto}}</td>
			<td>{{cliente.correo}}</td>
			<td>{{cliente.countAnuncios()}}</td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "clientes",
						"action" : "anuncios",
						"params" : cliente.id
					],
					"title":"Ver los anuncios de " ~ cliente.nombreCompleto,
					"text":"Ver anuncios",
					"class":"button is-small"
				])}}
			</td>
		</tr>
	{% endfor %}
	</tbody>
</table>

{# "action":"control/anuncios/ver/" ~ cliente.id, #}
