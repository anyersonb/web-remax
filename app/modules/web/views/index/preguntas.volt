<div id="faq">
		<h1>PREGUNTAS FRECUENTES</h1>
		<div class="linea_azul"></div>
		<!--
		<div class="filtros">
			<button type="button" data-id="1">categoria preguntas 1</button>
			<button class="" type="button" data-id="2">categoria preguntas 2</button>
			<button type="button" data-id="3">categoria preguntas 3</button>

		</div>
		-->
		<div class="faq_content">

			{% set account = 1 %}
			{% for preguntasfrecuente in preguntasfrecuentes %}
			<div class="box" data-categoria="1">
				<div class="alarm"></div>
				<span class="numero"><?php echo ($account<10)?'0':''; ?><?php echo $account; ?></span>
				<span class="pregunta">{{preguntasfrecuente.pregunta}}</span>
				<span class="descripcion">{{preguntasfrecuente.respuesta}}</span>
			</div>
			<?php $account++; ?>
			{% endfor %}


		</div>
	</div>
