

<?= $this->flash->output() ?>
<?= $this->flashsession->output() ?>



<div class="card">
	<header class="card-header">
		<p class="card-header-title">Nosotros (Bloque 1)</p>
	</header>
	<div class="card-content">

		<?= $this->tag->form(['control/contenido/guardarNosotros', 'method' => 'post']) ?>
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10"><?= (empty($nosotros->objeto) ? ('') : ($nosotros->objeto)) ?></textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		<?= $this->tag->endform() ?>

	</div>
</div>


<div class="card is-dark">

	<div class="card-content">
		<?= $this->tag->form(['control/contenido/guardarNosotros3', 'method' => 'post']) ?>
			<div class="field">
				<label class="label">Nosotros (Sumilla)</label>
				<div class="control">
					<input class="input" type="text" name="objeto" placeholder="Sumilla" value="<?= (empty($nosotros3->objeto) ? ('') : ($nosotros3->objeto)) ?>" required>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>
		<?= $this->tag->endform() ?>

	</div>
</div>


<div class="card">
	<header class="card-header">
		<p class="card-header-title">Nosotros (Bloque 2)</p>
	</header>
	<div class="card-content">

		<?= $this->tag->form(['control/contenido/guardarNosotros2', 'method' => 'post']) ?>
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10"><?= (empty($nosotros2->objeto) ? ('') : ($nosotros2->objeto)) ?></textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		<?= $this->tag->endform() ?>

	</div>
</div>
<div class="card">
	<header class="card-header">
		<p class="card-header-title">Términos y Condiciones</p>
	</header>
	<div class="card-content">

		<?= $this->tag->form(['control/contenido/guardarTerminos', 'method' => 'post']) ?>
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10"><?= (empty($tyc->objeto) ? ('') : ($tyc->objeto)) ?></textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		<?= $this->tag->endform() ?>

	</div>
</div>

<div class="card">
	<header class="card-header">
		<p class="card-header-title">Política de privacidad</p>
	</header>
	<div class="card-content">

		<?= $this->tag->form(['control/contenido/guardarPoliticas', 'method' => 'post']) ?>
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10"><?= (empty($politica->objeto) ? ('') : ($politica->objeto)) ?></textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		<?= $this->tag->endform() ?>

	</div>
</div>

		
<div class="card is-dark">
	<header class="card-header">
		<p class="card-header-title">
			Otros
		</p>
	</header>
	<div class="card-content">
		<?= $this->tag->form(['control/contenido/guardarEmail', 'method' => 'post']) ?>
			<div class="field">
				<label class="label">Email</label>
				<div class="control">
					<input class="input" type="email" name="email" placeholder="Email" value="<?= (empty($email->objeto) ? ('') : ($email->objeto)) ?>" required>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>
		<?= $this->tag->endform() ?>

	</div>
</div>

