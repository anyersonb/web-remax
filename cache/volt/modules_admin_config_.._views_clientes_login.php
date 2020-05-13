<div id="registro" class="section">
		<h1>Iniciar Sesión</h1>
		<div class="linea_azul"></div>
		
		<div class="registro_wrapper">
		
			<div class="registrarse">
			<h3>Bienvenidos a RE/MAX Design</h3>
			
			<div id="mensajes" style="color:red;">
				<?= $this->flash->output() ?>
				<?= $this->flashsession->output() ?>
			</div>
			<br/>
			<div class="linea_vertical"></div>
			<?= $this->tag->form(['admin/clientes/login']) ?>
			<div class="iniciar_sesion">
				
				<div class="label">Usuario *</div>
				<div><?= $this->tag->textField(['alias']) ?></div>
				<br/>
				<div class="label">Password *</div>
				<div><?= $this->tag->passwordField(['clave']) ?></div>
				<button type="submit" class="button">INICIAR SESIÓN</button>
				<p><a href="<?= $this->url->get('admin/clientes/recuperar') ?>">Olvidé mi contraseña</a></p>
				<?= $this->tag->linkto('admin/clientes/registro', 'Regístrate') ?>
			</div>
			<?= $this->tag->endform() ?>
		</div>
	</div>