<table class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Anuncio</th>
			<th>Tipo</th>
			<th>Estado</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{% for anuncio in cliente.Anuncios %}
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
			<td>{{anuncio.Tipo.titulo}}</td>
			<td><span class="tag">{{anuncio.estado}}</span></td>
			<td>
				{{ linkTo([
					"action": [
						"for" : "controlControllerAction",
						"controller" : "anuncios",
						"action" : "ver",
						"params" : cliente.id
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
