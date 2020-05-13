<div class="mobile_disabled">
<p>
¡Hola! Para poder usar el sistema por favor ingresa desde una laptop o computadora de escritorio, de esta manera podrás tener una vista completa de los cambios y subir imágenes. 
<br/>
<br/>
¡Gracias por ser parte de RE/MAX Design!
</p>
</div>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<div id="index">
	<div id="disenios" class="section">
		<h5>ENCUENTRA</h5>
		<h1>Tus diseños</h1>
		

		<div class="disenios_fila">
			<div class="disenios_titulo blue">
				<h1>Recientes</h1>
				<div><?= $this->length($disegnos) ?> ARCHIVOS</div>
			</div>
			<div class="disenios_wrapper" id="beneficios_slider">
				<div class="disenios_content">
					<?php $v179469938126942085461iterated = false; ?><?php foreach ($disegnos as $disegno) { ?><?php $v179469938126942085461iterated = true; ?>
						<div class="item_design">
						<div class="item_name"><?= $disegno->nombre ?></div>
						<div class="delete">

							<a href="<?= '/admin/diseños/delete/' . $disegno->id ?>">
							<i class="fas fa-trash"></i>
							</a>
							
						</div>
						<div class="edit">
							<a href="<?= '/admin/diseños/editor/#/editar/' . $disegno->id ?>">
							<i class="fas fa-edit"></i>
							</a>
						</div>
						<?= $this->tag->linkTo(['admin/diseños/editor/#/editar/' . $disegno->id, $this->tag->image([$disegno->previo]), 'class' => 'diseño item']) ?>
						</div>
					<?php } if (!$v179469938126942085461iterated) { ?>
						<div class="diseño">
							<?= $this->tag->linkTo(['admin/diseños/plantillas' . $disegno->id, 'Inicia un nuevo diseño aquí', 'class' => 'nuevo']) ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
