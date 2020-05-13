<table class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th class="col-anuncio">Anuncio</th>
			<th>Tipo</th>
			<th>Cliente</th>
			<th>Estado</th>
			<th>Fecha</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for anuncio in anuncios %}
		<tr>
			<td>
				<div class="columns">
					<div class="column is-narrow">
						<figure class="image is-96x96">
							<img src="{{ url("system/anuncios/imagen/" ~ anuncio.id ~ "/96")}}" alt="">
						</figure>
					</div>

					<div class="column">
						<div class="content is-small">
							<h4>{{ anuncio.titulo }}</h4>
							<p>{{ anuncio.descripcion }}</p>
						</div>
					</div>
				</div>
			</td>
			<td><p>{{anuncio.Tipo.titulo}}</p></td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "clientes",
						"action" : "ver",
						"params" : anuncio.Cliente.id
					],
					"title":"Cliente " ~ anuncio.Cliente.nombreCompleto,
					"text":anuncio.Cliente.nombreCompleto,
					"class":"button is-link is-outlined is-small"
				])}}

			</td>
			<td><span class="tag">{{anuncio.estado}}</span></td>
			<td><p><?= date("d-m-Y", strtotime($anuncio->creacion)) ?></p></td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "anuncios",
						"action" : "ver",
						"params" : anuncio.id
					],
					"title":"Ver " ~ anuncio.titulo,
					"text":"Ver",
					"class":"button is-small"
				])}}

			</td>
		</tr>
	{% endfor %}
	</tbody>
</table>
