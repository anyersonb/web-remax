
<section class="section">
	<div class="container">
		<div class="card">
			<div class="card-content">
				<div id="mensajes">
					{{ flash.output() }}
					{{ flashsession.output() }}
				</div>
				{{ form() }}

					{% for elemento in form %}
						{% if elemento.getUserOption("oculto") %}
							{{ elemento }}
						{% else %}
							<div class="field">
								{{ elemento.label(["class": "label"]) }}
								<div class="control">
									{{ elemento.render(["class": "input"]) }}
								</div>
								{% if elemento.hasMessages()  %}
									{% for mensaje in elemento.getMessages() %}
										<p class="help">{{mensaje}}</p>
									{% endfor %}
								{% endif %}
							</div>

						{% endif %}
					{% endfor %}
					<div class="field is-grouped is-grouped-right">
						<div class="control">
							<a class="button is-text" href="/control/preguntasfrecuentes/">Cancelar</a>
						</div>
						<div class="control">
							<button class="button is-dark">Guardar</button>
						</div>
					</div>

				{{ endForm() }}

			</div>
		</div>

	</div>
</section>
