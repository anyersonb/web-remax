<div id="facturas">
	
	<div class="tarjeta">
<input type="hidden" id="ticket" value="{{soporte['numero']}}"></input>
			<div class="campo">
				<label for="asunto"><b>Asunto:</b></label>
				{{soporte['asunto']}}
			</div>
			<div class="campo">
				<label for="mensaje"><b>Mensaje:</b></label>
				{{soporte['mensaje']}}
			</div>
			<div class="campo">
				<label for="asunto"><b>Fecha:</b></label>
				{{soporte['fecha']}}
			</div>
<br/> 
<div id="respuestas"></div>
<br/>

<div class="reply_box">
<textarea id="respuesta" rows="10" cols="60"></textarea>
<br/>
<button type="button" class="first_element" id="btn_responder">Responder</button>
</div>
</div>
</div>