$(function() {
 console.log('ready');
	$('#btn_cambiar').click(doCambiar);
});
var loading = false;
function doCambiar(){
	if(loading)return;
	var id_cliente = $('#id_cliente').val();
	var password = $('#password').val();
	var password_r = $('#password_repeat').val();
	if(password==""){
		alert("Debe especificar una contraseña");
		return;
	}
	if(password.length<8){
		alert("Las contraseña debe ser mayor a 8 caracteres");
		return;
	}
	if(password!=password_r){
		alert("Las contraseñas no coinciden");
		return;
	}
	loading = true;
	$("#btn_cambiar").css({ opacity: 0.5 });
	$.post( "/admin/clientes/cambiarp", { password: password,id_cliente:id_cliente}, function( data ) {
		 loading = false;
		$('#password').val('');
		$('#password_repeat').val('');
	  	if(data.status == "OK"){
		  	Swal.fire({
				  icon: 'success',
				  title: 'Contraseña Actualizada',
				  text: 'Su contraseña a sido actualizada',
				  showConfirmButton: false,
				})
		  	setTimeout(()=>{
			  	document.location.href = "/admin";
		  	}, 3000)
		  	
	  	}
	  	$("#btn_cambiar").css({ opacity: 0.5 });
	}, "json");
}