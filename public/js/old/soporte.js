$(function() {
  // Handler for .ready() called.
  $("#btn_create_ticket").click(doCreateTicket);
   $("#btn_sent_ticket").click(doSentTicket);
  
  //$("#create_ticket").hide();
  $("#btn_cancelar").click(doCancel);
  //loadTickets();
  if(String(document.location.href).indexOf('admin/soporte/index')!=-1){
	  loadTickets();
  }
  if(String(document.location.href).indexOf('admin/soporte/ticket')!=-1){
	  console.log("btn_responder")
    $("#btn_responder").click(replyTicket);
    refreshResponses();
  }
});
function doCreateTicket(){
	$("#btn_create_ticket").hide();
	$("#create_ticket").show();
}
function doCancel(){
	$("#create_ticket").hide();
	$("#btn_create_ticket").show();
}
function doSentTicket(){
	
	var params = {};
	params.asunto = $("#asunto").val();
	params.mensaje = $("#mensaje").val();
	
	if(params.asunto==""){
		alert("El asunto es requerido.")
		return
	}
	if(params.mensaje==""){
		alert("El mensaje es requerido.")
		return
	}
	
	$.post( "http://desarrollo.easyanuncios.com/admin/soporte/create",params,function( data ) {
	  $("#asunto").val('');
	  $("#mensaje").val('');
	  $("#create_ticket").hide();
	  $("#btn_create_ticket").show();
	  loadTickets();
	},'json'); 
}
function refreshResponses(){
	//console.log("refreshResponses");
	var ticket = $("#ticket").val();
	$.post( "http://desarrollo.easyanuncios.com/admin/soporte/ticketmsg",{ticket:ticket},function( data ) {
	 	console.log('RESP');
	 	console.log(data);
	 	var html = "";
	 	for(var i=0;i<data.mensajes.length;i++){
		 	var user_info = data.mensajes[i].usuario+" ("+data.mensajes[i].fecha+"):";
		 	html+="<p><b>"+user_info+"</b><br/>"+data.mensajes[i].mensaje+"</p><br/>";
	 	}
	 	$("#respuestas").html(html);
	},'json');	
	//reply_box
}
function loadTickets(){
	
	$.post( "http://desarrollo.easyanuncios.com/admin/soporte/list",function( data ) {
	  console.log(data.soporte);
	  
	 	var html = '';
		for(var i=0;i<data.soporte.length;i++){
			html+= '<tr>';
			html+='<td class="previo">'+data.soporte[i].nro_ticket+'</td>';
			html+='<td>'+data.soporte[i].asunto+'</td>';
			var url = "http://desarrollo.easyanuncios.com/admin/soporte/ticket/"+data.soporte[i].nro_ticket;
			html+='<td><a href="'+url+'">Ver</a></td>';
			html+='<td>'+data.soporte[i].fecha+'</td>';
			html+='</tr>';
		}
		$("#tickets_resultados tbody").html(html);
	
	
	},'json');
	
	
}
function replyTicket(e){
	 console.log("replyTicket")
	e.preventDefault();
	
	var ticket = $("#ticket").val();
	var params = {};
	params.respuesta = $("#respuesta").val();
	console.log("params.respuesta "+params.respuesta);
	if(params.respuesta==""){
		console.log("Swal");
		Swal.fire({
		  icon: 'error',
		  title: 'Ups...',
		  text: 'Debe de escribir una respuesta',
		})
		return; 
	}
	params.numero = ticket;
	console.log("SENT "+ticket);
	$.post( "http://desarrollo.easyanuncios.com/admin/soporte/responder",params,function( data ) {
		$("#respuesta").val('');
	 	refreshResponses();
	},'json');
}




