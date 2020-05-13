<article id="crear">
	<div class="publicar">

		<div id="mensajes">
			{{ flash.output() }}
			{{ flashsession.output() }}
		</div>

		<div class="tarjeta">
			<div class="previo oculto" id="previo"></div>
			<div class="anuncio">
				<p id="mensaje" class=""></p>
				<dl id="datos" class="oculto">
					<dt>ID</dt>
					<dd><span id="id"></span></dd>
					<dt>Nombre</dt>
					<dd><span id="nombre"></span></dd>
					<dt>Estado</dt>
					<dd><span id="estado"></span></dd>
				</dl>
			</div>
			<div class="espera" id="espera">
				<div class="contenido">
					<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
					<p>Procesando el anuncio</p>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
	//const FICHA = '{{ficha}}';
	const URL = '{{url("system/anuncios/publicar/" ~ ficha )}}';

</script>
