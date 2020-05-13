<article id="facturas">
	<div class="tarjeta">
		<p class="aviso">La constancia de la transaccion es enviada al correo electrónico que ingresaste al momento del pago.</p>
		<table>
			<thead>
				<tr>
					<th class="previo"></th>
					<th>Anuncio</th>
					<th>Inicio</th>
					<th>Tiempo</th>
					<th class="monto">Monto</th>
					<th>Transacción</th>
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
					<td class="monto">$ {{ campagna.monto }}</td>
					<td class="transaccion">
						{% if campagna.Factura.pago | default(false) %}
						<span>
						{{ campagna.Factura.pago | default("") }}
						</span>
						{% endif %}
					</td>
				</tr>
			{% endfor %}
			{% endfor %}

			</tbody>

		</table>
	</div>
</article>
