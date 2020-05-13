

<div id="registro" class="section">
		<h1>Registrarse</h1>
		
		<div id="mensajes">
			{{ flash.output() }}
			{{ flashsession.output() }}
		</div>
		<pre>{# dump(form.getElements()) #}</pre>
		
		<div class="linea_azul"></div>
		<div class="registro_wrapper">
			<div class="registrarse">
				
				{{ form() }}
				<div class="two_input">
					<div class="content_input">
						<div class="label">Nombres *</div>
						<div>{{ form.render('nombre') }}</div>
						<div class="error_msg">{{ form.messages('nombre') }}</div>
					</div>
					<div class="separator"></div>
					<div class="content_input">
						<div class="label">Apellidos *</div>
						<div>{{ form.render('apellido') }}</div>
						<div class="error_msg">{{ form.messages('apellido') }}</div>
					</div>
				</div>
				
				
				<div class="label">Oficina REMAX *</div>
				<div>{{ form.render('oficina') }}</div>
				<div class="error_msg">{{ form.messages('oficina') }}</div>
				
				<div class="label">Nombre de Usuario *</div>
				<div>{{ form.render('alias') }}</div>
				<div class="error_msg">{{ form.messages('alias') }}</div>
				
				<div class="label">Email *</div>
				<div>{{ form.render('correo') }}</div>
				<div class="error_msg">{{ form.messages('correo') }}</div>
				<div class="label">Password *</div>
				<div>{{ form.render('clave') }}</div>
				<div class="error_msg">{{ form.messages('clave') }}</div>
				<div class="terminos">
					{{ form.render('acepta') }}
					
					 <div>
					 He leído y acepto los  <a href="/terminos" id="terminos">términos y condiciones</a>
					 </div>
					 
				</div>
				<div class="error_msg">{{ form.messages('acepta') }}</div>
				<button class="button" type="submit">
					REGISTRARSE
				</button>
			</div>
			{{ endForm() }}
			
		</div>
	</div>
	<!--
	<div class="linea_vertical"></div>
			<div class="iniciar_sesion">
				<h3>Iniciar Sesíon</h3>
				<div class="label">Usuario o Email *</div>
				<div><input type="text"/></div>
				
				<div class="label">Password *</div>
				<div><input type="text"/></div>
				<button class="button" value="">
					INICIAR SESIÓN
				</button>
			</div>
			-->