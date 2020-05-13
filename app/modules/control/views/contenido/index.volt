

{{ flash.output() }}
{{ flashsession.output() }}



<div class="card">
	<header class="card-header">
		<p class="card-header-title">Nosotros (Bloque 1)</p>
	</header>
	<div class="card-content">

		{{ form("control/contenido/guardarNosotros", 'method': 'post' ) }}
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10">{{ nosotros.objeto | default("") }}</textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		{{ endForm() }}

	</div>
</div>


<div class="card is-dark">

	<div class="card-content">
		{{ form("control/contenido/guardarNosotros3", 'method': 'post' ) }}
			<div class="field">
				<label class="label">Nosotros (Sumilla)</label>
				<div class="control">
					<input class="input" type="text" name="objeto" placeholder="Sumilla" value="{{ nosotros3.objeto | default("") }}" required>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>
		{{ endForm() }}

	</div>
</div>


<div class="card">
	<header class="card-header">
		<p class="card-header-title">Nosotros (Bloque 2)</p>
	</header>
	<div class="card-content">

		{{ form("control/contenido/guardarNosotros2", 'method': 'post' ) }}
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10">{{ nosotros2.objeto | default("") }}</textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		{{ endForm() }}

	</div>
</div>
<div class="card">
	<header class="card-header">
		<p class="card-header-title">Términos y Condiciones</p>
	</header>
	<div class="card-content">

		{{ form("control/contenido/guardarTerminos", 'method': 'post' ) }}
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10">{{ tyc.objeto | default("") }}</textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		{{ endForm() }}

	</div>
</div>

<div class="card">
	<header class="card-header">
		<p class="card-header-title">Política de privacidad</p>
	</header>
	<div class="card-content">

		{{ form("control/contenido/guardarPoliticas", 'method': 'post' ) }}
			<div class="field">
					<div class="control">
					<textarea class="textarea" name="objeto" rows="10">{{ politica.objeto | default("") }}</textarea>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>

		{{ endForm() }}

	</div>
</div>

		
<div class="card is-dark">
	<header class="card-header">
		<p class="card-header-title">
			Otros
		</p>
	</header>
	<div class="card-content">
		{{ form("control/contenido/guardarEmail", 'method': 'post' ) }}
			<div class="field">
				<label class="label">Email</label>
				<div class="control">
					<input class="input" type="email" name="email" placeholder="Email" value="{{ email.objeto | default("") }}" required>
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-dark">Guardar</button>
				</div>
			</div>
		{{ endForm() }}

	</div>
</div>

