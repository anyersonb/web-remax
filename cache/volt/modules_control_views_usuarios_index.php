<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Nombre</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($usuarios as $usuario) { ?>
		<tr>
			<td><?= ucwords($usuario->nombre) ?></td>
			<td>
				<?= $this->tag->linkto(['action' => ['for' => 'controlControllerAction', 'controller' => 'usuarios', 'action' => 'editar', 'params' => $usuario->id], 'text' => 'Editar', 'class' => 'button is-small']) ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
