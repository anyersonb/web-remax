
<section class="section">
	<div class="container">
		<div class="card">
			<div class="card-content">
				<div id="mensajes">
					<?= $this->flash->output() ?>
					<?= $this->flashsession->output() ?>
				</div>
				<?= $this->tag->form(['enctype' => 'multipart/form-data']) ?>

					<?php foreach ($form as $elemento) { ?>
						<?php if ($elemento->getUserOption('oculto')) { ?>
							<?= $elemento ?>
						<?php } else { ?>
							<div class="field">
								<?= $elemento->label(['class' => 'label']) ?>
								<div class="control">
									<?= $elemento->render(['class' => 'input']) ?>
								</div>
								<?php if ($elemento->hasMessages()) { ?>
									<?php foreach ($elemento->getMessages() as $mensaje) { ?>
										<p class="help"><?= $mensaje ?></p>
									<?php } ?>
								<?php } ?>
							</div>

						<?php } ?>
					<?php } ?>
					<div class="field is-grouped is-grouped-right">
						<div class="control">
							<a class="button is-text" href="/control/tutoriales/">Cancelar</a>
						</div>
						<div class="control">
							<button class="button is-dark">Guardar</button>
						</div>
					</div>

				<?= $this->tag->endform() ?>

			</div>
		</div>

	</div>
</section>
