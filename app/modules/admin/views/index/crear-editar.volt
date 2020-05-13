<article id="crear">
	{{ form( "class":"formulario" ) }}
	<div class="editar">
		<div class="titulo">
			<h1>Configura tu anuncio</h1>
		</div>
		<div class="tarjeta pantalla">
			<div class="vista">
				<div class="control editor">
					<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt="imagen" id="imagen">
					{{ hidden_field("arte") }}
				</div>
				<div class="control subir">
					<label for="selectorImagen">Elegir imagen</label>
					<input id="selectorImagen" type="file" accept="image/*">

				</div>
			</div>
			<div class="encabezado">
				<div class="campo">
					<label for="titulo">Titulo</label>
					{{ text_field("titulo", "required":true) }}
				</div>
			</div>
			<div class="contenido">
				<div class="campo">
					<label for="descripcion">Descripción</label>
					{{ text_area("descripcion", "required":true) }}
				</div>
				<div class="campo">
					<label for="enlace">Enlace</label>
					{{ text_field("enlace", "required":true) }}
				</div>
			</div>
		</div>
		{#
		<div class="tarjeta pantalla">
			<figure class="vista">{{ image("img/editor.png") }}</figure>
			<div class="encabezado">
				<div class="titulo">{{ text_field("titulo") }}</div>
			</div>
			<div class="subtitulo">plantillas</div>
			<div class="plantillas">{{ image("img/muestras.png") }}</div>
			<div class="botones">
				<button type="button"><img src="img/ico-guardar.svg" alt=""></button>
				<button class="secundario" type="button"><span>Resetear</span></button>
			</div>
			<div class="mensajes">
				<div class="mensaje"><i class="fas fa-check"></i><span>Se guardó correctamente</span></div>
			</div>
		</div>
		#}
		<div class="botones">
			<button type="submit">continuar</button>
		</div>
	</div>
	{{ endForm() }}
</article>
