<div id="registro" class="section recuperar_password">
		<h1>Recuperar contraseña</h1>
		<div class="linea_azul"></div>
		
		<div class="registro_wrapper">
		
			<div class="registrarse">
			<h3>Escribe tu nueva contraseña</h3>
			
			<div id="mensajes" style="color:red;">
			</div>
			<br/>
			<div class="linea_vertical"></div>
			<div id="mensajes"></div>
			<form action="#">
				<input type="hidden" id="id_cliente" value="<?= $id_cliente ?>"/>
				<div class="label">Contraseña *</div>
				<input type="password" id="password" placeholder=""/>
				<div class="label">Repetir Contraseña *</div>
				<input type="password" id="password_repeat" placeholder=""/>
				<br/>
				<button type="button" id="btn_cambiar" class="button">Cambiar contraseña</button>
				
			</form>
			
			
		</div>
	</div>