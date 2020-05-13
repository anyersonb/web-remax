<table class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th class="id">#</th>
			<th>Anuncio</th>
			<th>Inicio</th>
			<th>Tiempo</th>
			<th>Monto</th>
			<th class="acciones"></th>
		</tr>
	</thead>

	<tbody>
	{% for anuncio in cliente.Anuncios %}
	{% for campagna in anuncio.Campagnas %}
		<tr>

			<td>{{ campagna.id }}</td>
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
			<td>{{ campagna.inicio }}</td>
			<td>{{ campagna.tiempo }} días</td>
			<td class="monto">S/ {{ campagna.monto }}</td>
			<td></td>
		</tr>
	{% endfor %}
	{% endfor %}

	</tbody>

</table>
