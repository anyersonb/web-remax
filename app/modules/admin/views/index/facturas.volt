


<article id="facturas">
	<div class="tarjeta">
		<table>
			<thead>
				<tr>
					<th class="previo"></th>
					<th>Anuncio</th>
					<th>Inicio</th>
					<th>Tiempo</th>
					<th>Monto</th>
					<th class="acciones"></th>
				</tr>
			</thead>

			<tbody>
			{% for anuncio in anuncios %}
			{% for campagna in anuncio.Campagnas %}
				<tr>
					<td class="previo">
						<figure>
							<img src="{{ url("system/anuncios/imagen/" ~ anuncio.id)}}" alt="">
						</figure>
					</td>
					<td class="titulo">{{ anuncio.titulo }}</td>
					<td>{{ campagna.inicio }}</td>
					<td>{{ campagna.tiempo }} días</td>
					<td class="monto">S/ {{ campagna.monto }}</td>
					<td></td>
				</tr>
			{% endfor %}
			{% endfor %}

			</tbody>

		</table>
	</div>
</article>
