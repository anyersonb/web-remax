
var loading = false;
$(function() {
 console.log('ready');
 	$('#btn_recuperar').click(doRecuperar);
});
function doRecuperar(){
	
	var correo = $('#correo').val();
	if(correo==""){
		alert("Debe especificar un correo electronico");
		return;
	}
	$("#btn_recuperar").css({ opacity: 0.5 });
	 loading = true;
	$.post( "/admin/clientes/forgot", { correo: correo}, function( data ) {
	  console.log( data.status );
	  if(data.status=="OK"){
		   Swal.fire({
				  icon: 'success',
				  title: 'Correo electronico enviado',
				  text: 'Se le envio un correo electronico con instrucciones para poder cambiar su contraseña',
				})
	  }else{
		  if(data.status=="NO_SE_ENCONTRO_CLIENTE"){
			  //alert("El correo electronico no se encuentra registrado");
			  Swal.fire({
				  icon: 'error',
				  title: 'Ups...',
				  text: 'El correo electronico no se encuentra registrado',
				})
		  }
		  
	  }
	   loading = false;
	  $("#btn_recuperar").css({ opacity: 1 });
	  $('#correo').val('');
	}, "json");
}