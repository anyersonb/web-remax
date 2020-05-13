{% set edades = session.get('datos')["edad"] | json_decode %}

<article id="crear">
	<div class="factura">
		<div class="tarjeta">
			<div class="titulo">
				<h1>Resumen</h1>
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

					<hr>

					<h2>Publico Objetivo</h2>
					<dl>
						<dt>Género</dt>
						<dd>{{ session.get('datos')["genero"] }}</dd>
						<dt>Rango de Edad</dt>
						<dd>Desde {{ edades[0] | abs }} hasta {{ edades[1] | abs }} años</dd>
						<dt>Lugares donde se mostrará el anuncio</dt>
						<dd>{{ session.get('datos')["lugares"] }}</dd>
					</dl>
				</div>
			</div>
		</div>

		<div class="botones">
			{# <a href="{{ url("admin/crear/publicar") }}">Publicar</a> #}
			<a href="{{ url("admin/crear/pagar") }}">Pagar  ${{campagna.monto}}</a>
		</div>
	</div>
</article>
