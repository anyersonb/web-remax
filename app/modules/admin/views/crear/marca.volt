{% set edades = session.get('datos')["edad"] | json_decode %}

<article id="crear">
	<div class="marca">
		<div class="tarjeta">
			<div class="titulo">
				<h1>Posicion de la marca</h1>
			</div>
			{{ form( "class":"formulario", "id":"formulario" ) }}
			{{ hidden_field("ordenada", "value":session.get("marca")["ordenada"] | default(0)) }}
			{{ hidden_field("abscisa", "value":session.get("marca")["abscisa"] | default(0)) }}
			{{ hidden_field("tamagno", "value":session.get("marca")["tamagno"] | default(0)) }}
			<div class="fila">
				<div class="control casilla">
					{{ check_field("mostrar", "id":"mostrar", "checked":session.get("marca")["mostrar"] | default(true)) }}
					<label for="mostrar">Colocar marca</label>
				</div>
			</div>

			<div class="info fila">
				<div class="celda span-12 control-tamagno">
					<p>Tamaño</p>
					<div id="slider-tamagno" class="deslizador"></div>
				</div>
			</div>
			<p>Posición</p>
			<p><small>Arrastra la marca a la posición deseada</small></p>
			<div class="info fila">
				<div class="celda previo">
					<figure>
						{{image("system/anuncios/imagen/" ~ anuncio.id ~ "/540", "id":"imagen")}}
						{{image("img/globo.png", "id":"marca")}}
					</figure>
				</div>
			</div>
			{{ endForm() }}
		</div>

		<div class="botones">
			<a href="javascript:history.back()" class="secundario">regresar</a>
			<button type="submit" form="formulario">Continuar</button>
		</div>
	</div>
</article>
