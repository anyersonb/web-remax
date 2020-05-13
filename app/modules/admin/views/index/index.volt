<article id="estadisticas">
	{#
	<div class="tarjeta valor">
		<div class="titulo">Vistas FB</div>
		<div class="grafico">{{ image("img/mini-grafico.png") }}</div>
		<div class="info">
		<h4>246K</h4>
		<p><i class="fas fa-long-arrow-alt-down"></i><span>33.9%</span></p>
		</div>
	</div>
	<div class="tarjeta valor">
		<div class="titulo">Vistas google</div>
		<div class="grafico">{{ image("img/mini-grafico.png") }}</div>
		<div class="info">
		<h4>246K</h4>
		<p><i class="fas fa-long-arrow-alt-down"></i><span>33.9%</span></p>
		</div>
	</div>
	<div class="tarjeta valor">
		<div class="titulo">Resta</div>
		<div class="grafico">{{ image("img/mini-grafico.png") }}</div>
		<div class="info">
		<h4>246K</h4>
		<p><i class="fas fa-long-arrow-alt-down"></i><span>33.9%</span></p>
		</div>
	</div>
	<div class="tarjeta x3">
		<div class="titulo">Estadisticas</div>
		<div class="info">{{ image("img/graficos.png") }}</div>
	</div>
	#}
	<div class="tarjeta x3">
		<div class="titulo">Anuncios activos</div>
		<div class="info">
		<table>
			<thead>
			<tr>
				<th class="id"><span>ID</span></th>
				<th><span>Anuncio</span></th>
				<th><span>Enlace</span></th>
				<th><span>Segmentación</span></th>
			</tr>
			</thead>
			<tbody>
			{% for anuncio in anunciosActivos  %}

			<tr>
				<td><span><?= str_pad($anuncio->id, 5, "0", STR_PAD_LEFT) ?></span></td>
				<td>
					<div class="media">
						<figure><img src="{{ url("system/anuncios/imagen/" ~ anuncio.id ~ "/96")}}" alt=""></figure>
						<div class="contenido">
							<p>{{ anuncio.titulo }}</p>
						</div>
					</div>
				</td>
				<td><a href="{{ anuncio.enlace }}" target="_blank">{{ anuncio.enlace }}</a></td>
				<td>
					<p><strong>Género</strong>: <span>{{ anuncio.genero }}</span></p>
					<p><strong>Rango de edad</strong>: <span>Desde {{ anuncio.edadMinima }} hasta {{ anuncio.edadMaxima }}</span></p>
					<p><strong>Lugar de residencia</strong>: <span></span>{{ anuncio.lugar }}</p>
				</td>
			</tr>
			{% endfor %}
			</tbody>
		</table>
		</div>
	</div>
	</article>
