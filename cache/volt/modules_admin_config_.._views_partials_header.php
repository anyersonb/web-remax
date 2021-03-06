<div id="header">
	<a href="/"><div id="logo"></div></a>
	<button id="alternar-menu">
		<?= $this->tag->image(['/img/open-menu.svg', 'class' => 'abrir']) ?>
		<?= $this->tag->image(['/img/close.svg', 'class' => 'cerrar']) ?>
	</button>
	<div id="menu">
		<div class="self">

			<?php if (($this->session->get('cliente'))) { ?>

			<?php if (($this->router->getRewriteUri() == '/admin/diseños/')) { ?>
				<div class="item_menu active"><a href="/admin/diseños/">Tus diseños</a></div>
			<?php } else { ?>
				<div class="item_menu"><a href="/admin/diseños/">Tus diseños</a></div>
			<?php } ?>

			<?php if (($this->router->getRewriteUri() == '/admin/diseños/plantillas/')) { ?>
				<div class="item_menu active"><a href="/admin/diseños/plantillas/">Plantillas</a></div>
			<?php } else { ?>
				<div class="item_menu"><a href="/admin/diseños/plantillas/">Plantillas</a></div>
			<?php } ?>


			<!--<div class="item_menu"><a href="/admin/clientes/papelera">Papelera</a></div>-->
			<?php } else { ?>
			<div class="item_menu"><a href="/tutoriales">Tutoriales</a></div>
			<div class="item_menu"><a href="/preguntas">Preguntas Frecuentes</a></div>
			<?php } ?>
		</div>

		<div class="user">


			<?php if (($this->session->get('cliente'))) { ?>
			<div class="item_menu nobar nobar_real">
				<?= $this->session->get('cliente')['alias'] ?>

				<style>
					#header #menu .item_menu.nobar a::before {
						content: none !important;
					}
					.out_btn {
						content: "";
						display: block;
						width: 30px;
						height: 30px;
						top: 0px;
						position: absolute;
						background-color: transparent;
						margin-left: 10px;
					}
					.out_btn img{
						width: 25px !important;
						height: 25px !important;
						max-width: none !important;
						padding: 0px !important;
					}
					</style>
				<a href="/admin/clientes/salir" title="Cerrar sesión"  alt="Cerrar sesión" class="out_btn">
					<img title="Cerrar sesión"  alt="Cerrar sesión" src="/img/power_button.png" class="ico_out">
				</a>

			</div>
			<?php } else { ?>
			<div class="item_menu nobar"><a href="/admin/clientes/registro">Regístrate</a></div>
			<div class="item_menu nobar" id="btn_login_">
					<a href="/admin/clientes/login">
						<span class="iniciar_sesion_text">Iniciar sesión</span> <img class="iniciar_sesion_img" title="Iniciar sesión" alt="Iniciar sesión" src="/img/user.png" width="20px"/>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>


<?php if (($this->session->get('cliente'))) { ?>
<div class="box_login" id="box_login">
	<input type="text" placeholder="Usuario o Email *"/>
	<div class="password_and_login">
		<input type="password" placeholder="Password *"/>
		<div class="button_login" value="">
			<img src="img/ico_login.png" />
		</div>
	</div>
</div>
<?php } ?>
