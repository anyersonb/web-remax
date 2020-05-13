
<div id="registro" class="section">
		<h1>Recuperar contraseña</h1>
		<div class="linea_azul"></div>
		
		<div class="registro_wrapper">
		
			<div class="registrarse">
			<h3>Sigue las instrucciones</h3>
			
			<div id="mensajes" style="color:red;">
				<?= $this->flash->output() ?>
				<?= $this->flashsession->output() ?>
			</div>
			<br/>
			<div class="linea_vertical"></div>
			<?= $this->tag->form([]) ?>
			<div class="iniciar_sesion">
				
				<div class="label" style="text-align: center;">Escribe tu correo para restablecer tu contraseña</div>
				<div><?= $form->render('correo') ?></div>
				<div class="error_msg"><?= $form->messages('correo') ?></div>
				<button type="button" id="btn_recuperar" class="button">RECUPERAR</button>
			</div>
			<?= $this->tag->endform() ?>
		</div>
	</div>