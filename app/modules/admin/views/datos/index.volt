<section id="datos">
	<article>
		<div id="mensajes">
			{{ flash.output() }}
			{{ flashsession.output() }}
		</div>
		{{ form() }}
			<div class="campo">
				{{ form.render('nombre') }}
				{{ form.label('nombre') }}
				{{ form.messages('nombre') }}
			</div>
			<div class="campo">
				{{ form.render('apellido') }}
				{{ form.label('apellido') }}
				{{ form.messages('apellido') }}
			</div>
			<div class="campo">
				{{ form.render('alias') }}
				{{ form.label('alias') }}
				{{ form.messages('alias') }}
			</div>
			<div class="campo">
				{{ form.render('correo') }}
				{{ form.label('correo') }}
				{{ form.messages('correo') }}
			</div>
			<div class="campo">
				{{ form.render('celular') }}
				{{ form.label('celular') }}
				{{ form.messages('celular') }}
			</div>						
			<div class="botones">
				<button type="submit">Actualizar datos</button>
			</div>

		{{ endForm() }}
	</article>

	<pre>{# dump(form.getElements()) #}</pre>
</section>
