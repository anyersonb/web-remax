<section class="hero is-dark is-fullheight">
	<div class="hero-body">
		<div class="container">
			<div class="columns is-centered">
			<div class="column is-5-tablet is-4-desktop is-3-widescreen">
				<div id="mensajes">
					<?= $this->flash->output() ?>
					<?= $this->flashsession->output() ?>
				</div>

				<?= $this->tag->form(['control/usuarios/login', 'class' => 'box']) ?>
				<div class="field">
					<label for="nombre" class="label">Usuario</label>
					<div class="control has-icons-left">
					<?= $this->tag->textField(['nombre', 'class' => 'input']) ?>
					<span class="icon is-small is-left">
						<?= $this->controlTags->featherIcon('user') ?>
					</span>
					</div>
				</div>
				<div class="field">
					<label for="clave" class="label">Contraseña</label>
					<div class="control has-icons-left">
					<?= $this->tag->passwordField(['clave', 'class' => 'input']) ?>
					<span class="icon is-small is-left">
						<?= $this->controlTags->featherIcon('lock') ?>
					</span>
					</div>
				</div>
				<div class="field is-grouped is-grouped-right">
					<button class="button is-success">
					Ingresar
					</button>
				</div>
				<?= $this->tag->endform() ?>
			</div>
			</div>
		</div>
	</div>
</section>
