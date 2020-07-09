var usoActividadFormAlta;
var usoActividadFormModi;
$(document).ready(function(){	
	$("#btnCerrarSesion").click(function(){
		location.href='../destruirSesion.php';
	});
	$("#cargaInfo").click(function(){
		creaTabla();
	});
	$("#vaciaInfo").click(function(){
		borraTabla();
	});
	$("#ID").click(function(){
		$("#orden").val("ID");
		creaTabla();
	});
	$("#Nombre").click(function(){
		$("#orden").val("Nombre");
		creaTabla();
	});
	$("#Apellido").click(function(){
		$("#orden").val("Apellido");
		creaTabla();
	});
	$("#Actividad").click(function(){
		$("#orden").val("Actividad");
		creaTabla();
	});
	$("#Fecha").click(function(){
		$("#orden").val("Fecha");
		creaTabla();
	});

	usoActividadFormAlta = false;
	usoActividadFormModi = false;
	creaOpciones();					
	$("#btnVentanaModalFormAlta").attr("disabled",true);
	$("#vaciaInfo").attr("disabled",true);

	$("#btnVentanaModalFormAlta").click(function(){
		$("#divModalFormAlta").show();	
		obtenerID();
		vaciaFormAlta();
		todoListoParaAlta();
		$("#divExterno").attr("class","desactivado");
	});

	$("#btnSalirFormAlta").click(function(){
		$("#divModalFormAlta").hide();
		$("#divExterno").attr("class","activado");
		usoActividadFormAlta = false;
	});

	$("#btnSalirFormModi").click(function(){
		$("#divModalFormModi").hide();
		$("#divExterno").attr("class","activado");
		usoActividadFormModi = false;
	});

	$("#btnEnviarFormModi").click(function(){
		modi();
		vaciaFormModi();
		$("#divModalFormResp").show();
		$("#divModalFormModi").hide();				
	});

	$("#btnEnviarFormAlta").click(function(){
		alta();		
		vaciaFormAlta();
		$("#divModalFormResp").show();
		$("#divModalFormAlta").hide();		
	});

	$("#btnSalirFormResp").click(function(){
		$("#divModalFormResp").hide();
		$("#divExterno").attr("class","activado");
	});

	$("#nombreVisitaFormAlta").keyup(function(){
		todoListoParaAlta();
	});
	$("#nombreVisitaFormAlta").change(function(){
		todoListoParaAlta();
	});
	$("#apellidoVisitaFormAlta").keyup(function(){
		todoListoParaAlta();
	});
	$("#apellidoVisitaFormAlta").change(function(){
		todoListoParaAlta();
	});
	$("#detalleActividadFormAlta").keyup(function(){
		usoActividadFormAlta = true;
		todoListoParaAlta();
	});
	$("#detalleActividadFormAlta").change(function(){
		usoActividadFormAlta = true;
		todoListoParaAlta();
	});	
	$("#fechaVisitaFormAlta").keyup(function(){
		todoListoParaAlta();
	});
	$("#fechaVisitaFormAlta").change(function(){
		todoListoParaAlta();
	});

	$("#nombreVisitaFormModi").keyup(function(){
		todoListoParaModi();
	});
	$("#nombreVisitaFormModi").click(function(){
		todoListoParaModi();
	});
	$("#apellidoVisitaFormModi").keyup(function(){
		todoListoParaModi();
	});	
	$("#apellidoVisitaFormModi").click(function(){
		todoListoParaModi();
	});	
	$("#detalleActividadFormModi").keyup(function(){
		usoActividadFormModi = true;
		todoListoParaModi();
	});
	$("#detalleActividadFormModi").click(function(){
		usoActividadFormModi = true;
		todoListoParaModi();
	});
	$("#fechaVisitaFormModi").keyup(function(){
		todoListoParaModi();
	});
	$("#fechaVisitaFormModi").click(function(){
		todoListoParaModi();
	});
});

function vaciaFormAlta(){	
	$("#nombreVisitaFormAlta").val("");
	$("#apellidoVisitaFormAlta").val("");
	$("#fechaVisitaFormAlta").val("");
}

function vaciaFormModi(){	
	$("#idVisitaFormModi").val("");
	$("#nombreVisitaFormModi").val("");
	$("#apellidoVisitaFormModi").val("");
	$("#fechaVisitaFormModi").val("");
}

function creaOpciones() {
	var objAjaxOpciones = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{accion:"salidaActividades"},
		success:function(replyServer,state){
			objJsonOpciones=JSON.parse(replyServer);
			objJsonOpciones.deportes.forEach(function(argValor,argIndice){
				var objOpcion = document.createElement("option");			
				objOpcion.setAttribute("value",argValor.Nombre);
				objOpcion.setAttribute("class","elementoOpcion");
				objOpcion.innerHTML = argValor.Nombre;
				document.getElementById("detalleActividadFormAlta").appendChild(objOpcion);        				      
			});
			objJsonOpciones.deportes.forEach(function(argValor,argIndice){
				var objOpcion = document.createElement("option");			
				objOpcion.setAttribute("value",argValor.Nombre);
				objOpcion.setAttribute("class","elementoOpcion");
				objOpcion.innerHTML = argValor.Nombre;
				document.getElementById("detalleActividadFormModi").appendChild(objOpcion);        				      
			});
		}
	});
}

function obtenerID(){
	var objAjax = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{accion:"obtenerID"},
		success:function(replyServer,state){
			objJasonID=JSON.parse(replyServer);
			$("#idVisitaFormAlta").val(objJasonID.idFaltante);							
		}
	});
}

function completaFichaVisita(numID){
	var objAjax = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{
			accion:"salidaVisita",
			id:numID
			},
		success:function(replyServer,state){
			objJsonVisita=JSON.parse(replyServer);
			$("#idVisitaFormModi").val(objJsonVisita.ID);
			$("#nombreVisitaFormModi").val(objJsonVisita.Nombre);
			$("#apellidoVisitaFormModi").val(objJsonVisita.Apellido);
			$("#detalleActividadFormModi").val(objJsonVisita.Actividad);
			$("#fechaVisitaFormModi").val(objJsonVisita.Fecha);						
		}
	});
}

function todoListoParaAlta(){
	if( document.getElementById("nombreVisitaFormAlta").checkValidity()==true && document.getElementById("apellidoVisitaFormAlta").checkValidity()==true && usoActividadFormAlta==true && document.getElementById("fechaVisitaFormAlta").checkValidity()==true ){
		$("#btnEnviarFormAlta").attr("disabled",false);
	}
	else{
		$("#btnEnviarFormAlta").attr("disabled",true);
	}
}

function todoListoParaModi(){
	if( document.getElementById("nombreVisitaFormModi").checkValidity()==true && document.getElementById("apellidoVisitaFormModi").checkValidity()==true && document.getElementById("fechaVisitaFormModi").checkValidity()==true || usoActividadFormModi==true){
		$("#btnEnviarFormModi").attr("disabled",false);
	}
	else{
		$("#btnEnviarFormModi").attr("disabled",true);
	}
}

function alta(){
	$("#respuesta").empty();
	$("#respuesta").html("Esperando respuesta...");
	var objAjax = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{
			accion:"alta",
			id:$("#idVisitaFormAlta").val(),
			nombre:$("#nombreVisitaFormAlta").val(),
			apellido:$("#apellidoVisitaFormAlta").val(),
			actividad:$("#detalleActividadFormAlta").val(),
			fecha:$("#fechaVisitaFormAlta").val(),
		},
		success:function(replyServer,state){
			borraTabla();
			creaTabla();	
			$("#respuesta").empty();
			if(state=="success"){
				$("#respuesta").html("Alta efectuada con éxito!");
			}
			else{
				$("#respuesta").html("No pudo efectuarse el alta solicitada");
			}
		}
	});
}

function modi(){
	$("#respuesta").empty();
	$("#respuesta").html("Esperando respuesta...");
	var objAjax = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{
			accion:"modi",
			id:$("#idVisitaFormModi").val(),
			nombre:$("#nombreVisitaFormModi").val(),
			apellido:$("#apellidoVisitaFormModi").val(),
			actividad:$("#detalleActividadFormModi").val(),
			fecha:$("#fechaVisitaFormModi").val(),
		},
		success:function(replyServer,state){
			borraTabla();
			creaTabla();
			$("#respuesta").empty();
			if(state=="success"){
				$("#respuesta").html("Modificación efectuada con éxito!");
			}
			else{
				$("#respuesta").html("No pudo efectuarse la modificación solicitada");
			}
		}
	});
}

function baja(numID){
	$("#respuesta").empty();
	$("#respuesta").html("Esperando respuesta...");
	var objAjax = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{
			accion:"baja",
			id:numID
			},
		success:function(replyServer,state){
			borraTabla();
			creaTabla();
			$("#respuesta").empty();
			if(state=="success"){
				$("#respuesta").html("Baja efectuada con éxito!");
			}
			else{
				$("#respuesta").html("No pudo efectuarse la baja solicitada");
			}
		}
	});
}

function creaTabla() {	
	$("#registros").empty();
	$("#cuerpoTabla").empty();
	$("#registros").html("Aguarde");	
	$("#cuerpoTabla").html("<p>Esperando respuesta...</p>");
	var objAjax = $.ajax({
		type:"get",
		url:"./servidor.php",
		data:{
			accion:"salidaVisitas",
			orden:$("#orden").val(),
			inpID:$("#inpID").val(),
			inpNombre:$("#inpNombre").val(),
			inpApellido:$("#inpApellido").val(),
			inpActividad:$("#inpActividad").val(),
			inpFecha:$("#inpFecha").val()
		},
		success:function(respuestaServidor,estado){
			$("#registros").empty();
			$("#cuerpoTabla").empty();
			objJson=JSON.parse(respuestaServidor);
			objJson.visitas.forEach(function(argValor, argIndice){
				var objTr = document.createElement("tr");		

				var objTd1 = document.createElement("td");
				objTd1.setAttribute("campo-dato","ID");
				objTd1.innerHTML = argValor.ID;
				objTr.appendChild(objTd1);

				var objTd2 = document.createElement("td");
				objTd2.setAttribute("campo-dato","Nombre");
				objTd2.innerHTML = argValor.Nombre;
				objTr.appendChild(objTd2);
				
				var objTd3 = document.createElement("td");
				objTd3.setAttribute("campo-dato","Apellido");
				objTd3.innerHTML = argValor.Apellido;
				objTr.appendChild(objTd3);
				
				var objTd4 = document.createElement("td");
				objTd4.setAttribute("campo-dato","Actividad");
				objTd4.innerHTML = argValor.Actividad;
				objTr.appendChild(objTd4);

				var objTd5 = document.createElement("td");
				objTd5.setAttribute("campo-dato","Fecha");
				objTd5.innerHTML = argValor.Fecha;
				objTr.appendChild(objTd5);

				var objTd6 = document.createElement("td");
				objTd6.setAttribute("campo-dato","Modificación");
				objTd6.innerHTML = "<button class='btTabla'>Modificar</button>";
				objTd6.onclick=function(){
					$("#divModalFormModi").show();
					$("#divExterno").attr("class","desactivado");					
					vaciaFormModi();
					todoListoParaModi();
					completaFichaVisita(argValor.ID);
				}
				objTr.appendChild(objTd6);

				var objTd7 = document.createElement("td");
				objTd7.setAttribute("campo-dato","Baja");
				objTd7.innerHTML = "<button class='btTabla'>Eliminar</button>";
				objTd7.onclick=function(){					
					if(confirm("Está seguro que desea dar de baja la visita seleccionada?")){
						baja(argValor.ID);						
						$("#divModalFormResp").show();		
						$("#divExterno").attr("class","desactivado");				
					}										
				}
				objTr.appendChild(objTd7);

				document.getElementById("cuerpoTabla").appendChild(objTr);
			});
			$("#registros").html(objJson.visitas.length);
			$("#btnVentanaModalFormAlta").attr("disabled",false);
			$("#vaciaInfo").attr("disabled",false);			
		}
	});
}

function borraTabla(){
	$("#btnVentanaModalFormAlta").attr("disabled",true);
	$("#vaciaInfo").attr("disabled",true);
	$("#cuerpoTabla").empty();
	$("#registros").empty();
};