<style>
.tyc_content{
	display:block;
	margin:40px auto;
	max-width:70%;
	text-align:left;
	font-family: "montserratregular";
	color: #808080;
	line-height: 1.4;
}
<?php if($modal){ ?>
	#header{
		display:none;
	}
	footer{
		display:none;
	}
	.bloque_blanco{
		display:none;
	}
	#tutoriales{
		padding-top:10px;
	}
<?php } ?>
</style>
<div id="tutoriales">
		<h1>TÉRMINOS Y CONDICIONES</h1>
		<div class="linea_azul"></div>
		<div class="tyc_content">
			<p>
				<?php echo $tyc->objeto;?>
			</p>
		</div>
	</div>