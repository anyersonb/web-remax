$(function() {
  
  	if(String(document.location.href).indexOf('control/soporte/index')!=-1){
		  loadTickets();
	}
  	if(String(document.location.href).indexOf('control/soporte/ticket')!=-1){
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
function loadTickets(){
	 
	$.post( "http://desarrollo.easyanuncios.com/control/soporte/list",function( data ) {
	 	var html = '';
		for(var i=0;i<data.soporte.length;i++){
			html+= '<tr>';
			html+='<td class="previo">'+data.soporte[i].nro_ticket+'</td>';
			html+='<td>'+data.soporte[i].asunto+'</td>';
			html+='<td>'+data.soporte[i].usuario+'</td>';
			html+='<td>'+data.soporte[i].fecha+'</td>';
			var url = "http://desarrollo.easyanuncios.com/control/soporte/ticket/"+data.soporte[i].nro_ticket;
			html+='<td><a href="'+url+'">Ver</a></td>';
			html+='</tr>';
		}
		$("#tickets_resultados tbody").html(html);
	
	  
	},'json');
	
	
}
function refreshResponses(){
	console.log("refreshResponses");
	var ticket = $("#ticket").val();
	$.post( "http://desarrollo.easyanuncios.com/control/soporte/ticketmsg",{ticket:ticket},function( data ) {
	 	console.log('RESP');
	 	console.log(data);
	 	var html = "";
	 	for(var i=0;i<data.mensajes.length;i++){
		 	var user_info = data.mensajes[i].usuario+" ("+data.mensajes[i].fecha+"):";
		 	html+="<p><b>"+user_info+"</b><br/>"+data.mensajes[i].mensaje+"</p><br/>";
	 	}
	 	$("#respuestas").html(html);
	},'json');	
}
function replyTicket(e){
	e.preventDefault();
	var ticket = $("#ticket").val();
	var params = {};
	params.respuesta = $("#respuesta").val();
	params.numero = ticket;
	$.post( "http://desarrollo.easyanuncios.com/control/soporte/responder",params,function( data ) {
		$("#respuesta").val('');
	 	refreshResponses();
	},'json');
}




