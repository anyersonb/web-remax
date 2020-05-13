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
						<dd>{{campagna.inicio}}</dd>
						<dt>Tiempo</dt>
						<dd>{{campagna.tiempo}} días</dd>
						<dt>Inversión</dt>
						<dd>$ {{campagna.monto}}</dd>
					</dl>
				</div>

			</div>
		</div>

		<div class="botones">
			<a href="{{ url("admin/index/facturas") }}">Pagar</a>
		</div>
	</div>
</article>
