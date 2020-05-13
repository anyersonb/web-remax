<article id="crear">
	<div class="factura">
		<div class="tarjeta">
			<div class="titulo">
				<h1>factura</h1>
			</div>
			<div class="info fila">
				<div class="celda span-3 previo">

					<h2>Tu anuncio</h2>
					<div class="panel">
						<h3>{{factura.Campagna.Anuncio.titulo}}</h3>
						<figure>
							<img src="{{ url("system/anuncios/imagen/" ~ factura.Campagna.Anuncio.id)}}" alt="">
							<figcaption>{{factura.Campagna.Anuncio.descripcion}}</figcaption>
						</figure>
					</div>
				</div>
				<div class="celda span-9 detalle">

					<h2>Tu Inversión</h2>
					<dl>
						<dt>Desde</dt>
						<dd>{{factura.Campagna.inicio}}</dd>
						<dt>Tiempo</dt>
						<dd>{{factura.Campagna.tiempo}} días</dd>
						<dt>Inversión</dt>
						<dd>$ {{factura.Campagna.monto}}</dd>
					</dl>
				</div>
			</div>
		</div>

		<div class="botones">
			<a href="{{ url("admin/crear/publicar") }}">Publicar</a>
		</div>
	</div>
</article>
