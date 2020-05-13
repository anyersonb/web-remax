<div class="mobile_disabled">
<p>
¡Hola! Para poder usar el sistema por favor ingresa desde una laptop o computadora de escritorio, de esta manera podrás tener una vista completa de los cambios y subir imágenes. 
<br/>
<br/>
¡Gracias por ser parte de RE/MAX Design!
</p>
</div>
<div id="plantillas" class="section">
	<h5>CREA TU ANUNCIO</h5>
	<h1>Plantillas <?= $actual->nombre ?></h1>


	<?php if ($actual) { ?>

	<div class="plantillas_wrapper" id="plantillas_slider">
		<div class="plantillas_content">
			<div class="box plantilla">
				<figure><?= $this->tag->image(['/img/plantillas/tipo/' . $actual->previo]) ?></figure>
				<h3><?= $actual->nombre ?></h3>
				<?= $actual->descripcion ?>
			</div>

			<?php foreach ($plantillas as $plantilla) { ?>
				<?= $this->tag->linkTo(['admin/diseños/editor/#/crear/' . $plantilla->id, '<figure>' . $this->tag->image(['/img/plantillas/previo/' . $plantilla->previo]) . '</figure>', 'class' => 'box previo']) ?>
			<?php } ?>
		</div>
	</div>
	<?php } else { ?>

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
			<?php foreach ($tipos as $tipo) { ?>
				<a href="/admin/diseños/plantillas/<?= $tipo->id ?>"
					class="box plantilla <?= ((($tipo->activo) ? '' : ' deshabilitado')) ?>"
					>
					<figure><?= $this->tag->image(['/img/plantillas/tipo/' . $tipo->previo]) ?></figure>

					<h3><?= $tipo->nombre ?></h3>
					<?= $tipo->descripcion ?>
					<p><strong>TAP/CLIC AQUÍ</strong></p>
				</a>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
</div>


<style>
.deshabilitado{
	opacity: 0.5;
	cursor: not-allowed;
}
</style>
