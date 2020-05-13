
<h1>Ticket <b>{{soporte['numero']}}</b></h1>
<input type="hidden" id="ticket" value="{{soporte['numero']}}"></input>
<br/>
			<div class="campo">
				<label for="asunto"><b>Usuario:</b></label>
				{{soporte['usuario']}}
			</div>
			<div class="campo">
				<label for="asunto"><b>Nombre:</b></label>
				{{soporte['usuario_nombre']}}
			</div>
			
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
<textarea id="respuesta" rows="10" cols="60"></textarea>
<br/>
<a href="#" onclick="replyTicket(event);" class="button is-dark" title="Responder">Responder</a>