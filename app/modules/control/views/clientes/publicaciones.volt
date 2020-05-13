<section class="hero is-dark">
	<div class="hero-body">
		<div class="container">
		<h1 class="title">Cliente: {{cliente.nombreCompleto}}</h1>
		</div>
	</div>
</section>

<section class="section" >
	<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
		<thead>
			<tr>
				<th>ID</th>
				<th>Identificador</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		{% for publicacion in cliente.Publicaciones %}
			<tr>
				<td>{{publicacion.id}}</td>
				<td>{{publicacion.codigo}}</td>
				<td></td>
				<td align="right">
				{{
					linkTo([
						"action": [
							"for" : "controlControllerIdAction",
							"controller" : "publicaciones",
							"action" : "difusiones",
							"id" : publicacion.id
						],
						"title":"Ver los anuncios de " ~ publicacion.codigo,
						"text":"Ver anuncios",
						"class":"button is-small"
					])
				}}
				</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
</section>
