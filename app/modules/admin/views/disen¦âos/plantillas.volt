<div id="plantillas" class="section">
	<h5>CREA TU ANUNCIO</h5>
	<h1>Plantillas {{ actual.nombre }}</h1>


	{% if actual %}

	<div class="plantillas_wrapper" id="plantillas_slider ">
		<div class="plantillas_content">
			<div class="box plantilla">
				<figure>{{ image("/img/plantillas/tipo/"~actual.previo) }}</figure>
				<h3>{{actual.nombre}}</h3>
				{{actual.descripcion}}
			</div>

			{% for plantilla in plantillas %}
				{{ link_to('admin/diseños/editor/#/crear/' ~ plantilla.id, "<figure>" ~ image("/img/plantillas/previo/" ~ plantilla.previo ) ~ "</figure>", "class":"box previo" ) }}
			{% endfor %}
		</div>
	</div>
	{% else %}

	<div class="plantillas_wrapper" id="beneficios_slider">
		<div class="plantillas_content">
			<div class="box titular">
				<div class="titulo">
					<h2>
						<strong>RX Design</strong><br>
						<span>plantillas especialmente pensadas para Agentes RE/MAX</span>
					</h2>
				</div>
				<div class="subtitulo">
					<p><strong>¡BIENVENIDOS!</strong></p>
					<p>En este espacio podrás seleccionar los diseños que mejor se adecúen a tus necesidades. Escoge si deseas diseñar para redes sociales o generar un archivo en ppt</p>
				</div>
			</div>
			{% for tipo in tipos %}
				<a href="/admin/diseños/plantillas/{{tipo.id}}"
					class="box plantilla {{ ((tipo.activo) ? "" :" deshabilitado") }}"
					>
					<figure>{{image("/img/plantillas/tipo/" ~ tipo.previo) }}</figure>

					<h3>{{tipo.nombre}}</h3>
					{{tipo.descripcion}}
					<p><strong>TAP/CLIC AQUÍ</strong></p>
				</a>
			{% endfor %}
		</div>
	</div>
	{% endif %}
</div>


<style>
.deshabilitado{
	opacity: 0.5;
	cursor: not-allowed;
}
</style>
