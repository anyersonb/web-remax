
<table id="lista" class="table is-fullwidth is-hoverable is-striped is-narrow">
	<thead>
		<tr>
			<th>Nombre Completo</th>
			<th>Correo Electrónico</th>
			<th>Editar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($clientes as $cliente) { ?>
		<tr>
			<td><?= $cliente->nombreCompleto ?></td>
			<td><?= $cliente->correo ?></td>
			<td>
				<?= $this->tag->linkto(['action' => ['for' => 'controlControllerAction', 'controller' => 'clientes', 'action' => 'editar', 'params' => $cliente->id], 'title' => 'editar ' . $cliente->nombreCompleto, 'text' => 'Editar', 'class' => 'button is-small']) ?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>


