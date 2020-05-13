
<article id="crear">
	<div class="factura">
		<div class="tarjeta">
			<div class="titulo">
				<h1>Resumen</h1>
			</div>
			<div id="mensajes">
				{{ flash.output() }}
				{{ flashsession.output() }}
			</div>
			<div class="info fila">
				<div class="celda span-3 previo">

					<h2>Tu anuncio</h2>
					<div class="panel">
						<h3>{{anuncio.titulo}}</h3>
						<figure>
							<img src="{{ url("system/anuncios/imagen/" ~ anuncio.id)}}" alt="">
							<figcaption>{{anuncio.descripcion}}</figcaption>
						</figure>
					</div>
				</div>
				<div class="celda span-9 detalle">

					<h2>Tu Inversión</h2>
					<dl>
						<dt>Desde</dt>
						<dd>{{anuncio.Campagnas[0].inicio}}</dd>
						<dt>Tiempo</dt>
						<dd>{{anuncio.Campagnas[0].tiempo}} días</dd>
						<dt>Inversión</dt>
						<dd>$ {{anuncio.Campagnas[0].monto}}</dd>
					</dl>

					<hr>

					<h2>Publico Objetivo</h2>
					<dl>
						<dt>Género</dt>
						<dd>{{ anuncio.genero }}</dd>
						<dt>Rango de Edad</dt>
						<dd>Desde {{ anuncio.edadMinima }} hasta {{ anuncio.edadMaxima }} años</dd>
						<dt>Lugares donde se mostrará el anuncio</dt>
						<dd>{{ anuncio.lugar }}</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</article>
