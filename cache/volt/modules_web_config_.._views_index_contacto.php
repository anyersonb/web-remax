
<style>

.mensaje.ok{
	    font-family: "montserratregular";
	    color:#014492;
}
textarea{
	font-family: "montserratregular";
	padding:20px;
	
	border-radius: 5px;
    font-size: 14px;
    letter-spacing: 0px;
    font-family: "montserratregular";
    outline: none;
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-style: solid;
    border: none;
    border-width: 1px;
    border: 1px solid #ccc;
    
}
.registro_wrapper .two_input .content_input{
		width: 80%;
}
</style>
<div id="registro" class="section">
		<h1>CONTACTO</h1>
		
		<div id="mensajes">
			<?= $this->flash->output() ?>
			<?= $this->flashsession->output() ?>
		</div>
		<pre></pre>
		
		<div class="linea_azul"></div>
		<div class="registro_wrapper">
			<div class="registrarse">
				
				<?= $this->tag->form([]) ?>
				<div class="two_input">
					<div class="content_input">
						<div class="label">Nombres *</div>
						<div><?= $form->render('nombre') ?></div>
						<div class="error_msg"><?= $form->messages('nombre') ?></div>
					</div>
					<div class="separator"></div>
					<div class="content_input">
						<div class="label">Apellidos *</div>
						<div><?= $form->render('apellido') ?></div>
						<div class="error_msg"><?= $form->messages('apellido') ?></div>
					</div>
				</div>
				
				
				<div class="two_input">
					<div class="content_input">
						<div class="label">Celular *</div>
						<div><?= $form->render('celular') ?></div>
						<div class="error_msg"><?= $form->messages('celular') ?></div>
					</div>
					<div class="separator"></div>
					<div class="content_input">
						<div class="label">Correo Electronico *</div>
						<div><?= $form->render('correo') ?></div>
						<div class="error_msg"><?= $form->messages('correo') ?></div>
					</div>
				</div>
				
				
				<div class="msj_area">
					<div class="msj_area_in">
						<div class="label">Mensaje *</div>
						<div><?= $form->render('mensaje') ?></div>
						<div class="error_msg"><?= $form->messages('mensaje') ?></div>
						
						
						<div class="terminos">
							
							
							 <div>
							¿Es agente REMAX? <?= $form->render('agente') ?>
							 </div>
					</div>	 
					</div>
				</div>

				<button class="button" type="submit">
					ENVIAR
				</button>
			</div>
			<?= $this->tag->endform() ?>
			
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