<div class="media">
	<div class="media-left">
		<span class="tag is-info is-large">
			<?= ucwords($this->session->usuario['nombre'][0]) ?>
		</span>
	</div>
	<div class="media-content">
		<p class="is-size-6 has-text-grey">
			<?= ucwords($this->session->usuario['nombre']) ?>
		</p>
		<?= $this->controlTags->enlace(['ruta' => ['for' => 'controlControllerAction', 'controller' => 'usuarios', 'action' => 'salir'], 'titulo' => 'Salir'], ['is-small is-size-7']) ?>
	</div>
</div>
<nav class="menu">
	<h3 class="menu-label subtitle is-6">Administración</h3>
	<ul class="menu-list">
		<?php foreach ($this->config->menuPrincipal as $item) { ?>
			<?php $clases = []; ?>
			<?php if ((empty($activo) ? ('.') : ($activo)) == (empty($item->nombre) ? ('-') : ($item->nombre))) { ?>
				<?php $clases = ['is-active']; ?>
			<?php } ?>
			<li><?= $this->controlTags->menuItem($item, (empty($clases) ? ([]) : ($clases))) ?></li>
		<?php } ?>
	</ul>

</nav>
