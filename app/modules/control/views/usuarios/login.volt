<section class="hero is-dark is-fullheight">
	<div class="hero-body">
		<div class="container">
			<div class="columns is-centered">
			<div class="column is-5-tablet is-4-desktop is-3-widescreen">
				<div id="mensajes">
					{{ flash.output() }}
					{{ flashsession.output() }}
				</div>

				{{ form('control/usuarios/login', "class":"box") }}
				<div class="field">
					<label for="nombre" class="label">Usuario</label>
					<div class="control has-icons-left">
					{{ text_field('nombre', "class":"input") }}
					<span class="icon is-small is-left">
						{{ controlTags.featherIcon("user") }}
					</span>
					</div>
				</div>
				<div class="field">
					<label for="clave" class="label">Contraseña</label>
					<div class="control has-icons-left">
					{{ password_field('clave', "class":"input") }}
					<span class="icon is-small is-left">
						{{ controlTags.featherIcon("lock") }}
					</span>
					</div>
				</div>
				<div class="field is-grouped is-grouped-right">
					<button class="button is-success">
					Ingresar
					</button>
				</div>
				{{ endForm() }}
			</div>
			</div>
		</div>
	</div>
</section>
