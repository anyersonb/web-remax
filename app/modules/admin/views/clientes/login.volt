<div id="registro" class="section">
		<h1>Iniciar Sesión</h1>
		<div class="linea_azul"></div>
		
		<div class="registro_wrapper">
		
			<div class="registrarse">
			<h3>Bienvenidos a RE/MAX Design</h3>
			
			<div id="mensajes" style="color:red;">
				{{ flash.output() }}
				{{ flashsession.output() }}
			</div>
			<br/>
			<div class="linea_vertical"></div>
			{{ form('admin/clientes/login') }}
			<div class="iniciar_sesion">
				
				<div class="label">Usuario *</div>
				<div>{{ text_field('alias') }}</div>
				<br/>
				<div class="label">Password *</div>
				<div>{{ password_field('clave') }}</div>
				<button type="submit" class="button">INICIAR SESIÓN</button>
				<p><a href="{{ url("admin/clientes/recuperar") }}">Olvidé mi contraseña</a></p>
				{{ linkTo("admin/clientes/registro", "Regístrate") }}
			</div>
			{{ endForm() }}
		</div>
	</div>