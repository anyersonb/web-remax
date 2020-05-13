<div id="facturas">
	
	<div class="tarjeta" id="create_ticket">
		<div class="formulario">
			<div class="campo">
				<label for="asunto">Asunto</label>
				{{ text_field("asunto", "required":true) }}
			</div>
			<div class="campo">
				<label for="mensaje">mensaje</label>
				{{ text_area("mensaje", "required":true) }}
			</div>
			<button type="submit" class="first_element" id="btn_sent_ticket">Crear Ticket</button>
			<button type="submit" class="gray" id="btn_cancelar">Cancelar</button>
		</div>
	</div>
	
	<div class="tarjeta">
		<div class="top_title">
			<h1>Tickets de soporte</h1>
			<button type="submit" class="" id="btn_create_ticket">Crear Ticket</button>
		</div>
				
		<table id="tickets_resultados">
			<thead>
				<tr>
					<th>Nro Ticket</th>
					<th>Asunto</th>
					<th></th>
					<th>Fecha</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td class="previo">
					</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>

		</table>

	</div>
</div>
