
<div id="index">

	<div id="disenios" class="section">
		<h5>ENCUENTRA</h5>
		<h1>Tus diseños</h1>
		<div class="controles_content">
			<div class="controles">
				<div class="search"><i class="fas fa-search"></i></div>
				<div class="order"><i class="fas fa-th"></i></div>
			</div>
		</div>

		<div class="disenios_fila">
			<div class="disenios_titulo blue">
				<h1>Recientes</h1>
				<div>{{disegnos | length}} ARCHIVOS</div>
			</div>
			<div class="disenios_wrapper" id="beneficios_slider">
				<div class="disenios_content">
					{% for disegno in disegnos %}
						{{ link_to(
							'admin/diseños/editor/#/editar/' ~ disegno.id,
							image(disegno.previo),
							"class": "diseño"
						)}}
					{% elsefor %}
						<div class="diseño">
							{{ link_to(
								'admin/diseños/plantillas' ~ disegno.id,
								"Inicia un nuevo diseño aquí",
								"class": "nuevo"
							)}}
						</div>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>
</div>
