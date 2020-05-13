<article id="crear">
	{{ form( "class":"formulario" ) }}
	<div class="inversion">
		<div class="tarjeta pantalla">
			<div class="campo">
				<label for="descripcion">Inicio</label>
				{{ date_field("inicio", "required":true, "value":date("Y-m-d")) }}
			</div>
			<div class="campo">
				<label for="descripcion">Tiempo (dias )</label>
				{{ numeric_field("tiempo", "required":true, "value":10, "class":"oculto") }}
				<div id="slider-tiempo" class="deslizador"></div>
			</div>
			<div class="campo">
				<label for="enlace">Inversión ($)</label>
				{{ numeric_field("monto", "required":true, "value":10, "class":"oculto") }}
				<div id="slider-monto" class="deslizador"></div>
			</div>
		</div>
		<div class="botones">
			<button type="submit">continuar</button>
		</div>
	</div>
	{{ endForm() }}
</article>
