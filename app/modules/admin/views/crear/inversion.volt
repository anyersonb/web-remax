<article id="crear">
	{{ form( "class":"formulario" ) }}
	{% set inversion = session.get("inversion") %}
	<div class="inversion">
		<div class="tarjeta pantalla">
			<div class="campo">
				<label for="descripcion">Inicio</label>
				{{ date_field("inicio", "required":true, "value":inversion["inicio"] | default(date("Y-m-d"))) }}
			</div>
			<div class="campo">
				<label for="descripcion">Tiempo (dias )</label>
				{{ numeric_field("tiempo", "required":true, "value":inversion["tiempo"] | default(5), "class":"oculto") }}
				<div id="slider-tiempo" class="deslizador"></div>
			</div>
			<div class="campo">
				<label for="monto">Inversión ($)</label>
				{{ numeric_field("monto", "required":true, "value":inversion["monto"] | default(10), "class":"oculto") }}
				<div id="slider-monto" class="deslizador"></div>
			</div>
			<div class="campo">
				<div class="presupuesto">
					<strong>Presupuesto:</strong>
					$<span id="diario">10</span> por día
				</div>
				<div class="ayuda">
					<p>El mínimo son $6 por día</p>
				</div>

			</div>
			<div class="campo casilla">
				{{ check_field("acepta", "required":true) }}
				<label for="acepta">
					<i class="fas fa-check"></i>
				</label>
				<label for="acepta">
					Acepto la {{linkTo(['terminos.html', 'Política de uso de información e inversión de Easy Anuncios', "class":"popup"])}}
				</label>
			</div>

			<div class="campo">
				{% set sexo = inversion["genero"] | default("Ambos") %}
				<label for="genero">Género</label>
				<div class="alternativas">
					<div class="control">
						<input id="genero-ambos" type="radio" name="genero" value="Ambos" {{ (sexo == "Ambos")?"checked":"unchecked" }}>
						<label for="genero-ambos">Ambos</label>
					</div>
					<div class="control">
						<input id="genero-hombres" type="radio" name="genero" value="Hombres" {{ (sexo == "Hombres")?"checked":"unchecked" }}>
						<label for="genero-hombres">Hombres</label>
					</div>
					<div class="control">
						<input id="genero-mujeres" type="radio" name="genero" value="Mujeres" {{ (sexo == "Mujeres")?"checked":"unchecked" }}>
						<label for="genero-mujeres">Mujeres</label>
					</div>
				</div>

			</div>
			<div class="campo">
				<label for="edad">Rango de edad</label>
				{{ text_field("edad", "required":true, "value":inversion["edad"] | default([0,0]) | json_encode, "class":"oculto") }}
				<div id="slider-edad" class="deslizador"></div>
			</div>


			<div class="campo">
				<label for="ubigeo">Ubicación geográfica</label>
				<div class="grupo">
					{{ select('departamento', departamentos,
						'id':"selectDepartamentos",
						'using': ['id', 'nombre'],
						'value': inversion["departamento"] | default("00"),
						'useEmpty': true,
						'emptyText': 'Elija un departamento',
						'emptyValue': '00') }}
					{{ select_static("provincia", [],
						'id':"selectProvincias",
						'useEmpty': true,
						'emptyText': 'Elija una provincia',
						'emptyValue': '00',
						"disabled": true) }}
					{{ select_static("distrito", [],
						'id':"selectDistritos",
						'useEmpty': true,
						'emptyText': 'Elija un distrito',
						'emptyValue': '00',
						"disabled": true) }}
				</div>
			</div>


			<div class="campo" id="campoLugares">
				<label for="lugar">Elige el lugar donde se mostrará tu anuncio:</label>
				<input id="inputLugares" type="text" name="lugares">

			</div>
		</div>
		<div class="botones">
			<a href="javascript:history.back()" class="secundario">regresar</a>
			<button type="submit">continuar</button>
		</div>
	</div>
	{{ endForm() }}
</article>
