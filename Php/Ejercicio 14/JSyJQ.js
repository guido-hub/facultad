var venRegistro;
var venDetalle;
var order;
$(document).ready(function(){
    venRegistro=false;
    venDetalle=false;
    order="Numero";
    listoParaAlta();
    listoParaLogIn();
    
    $("#btnCargaUser").click(function(){
        cargaUsers("Actualizar");
    });
    $("#btnVaciaUser").click(function(){
        borraUsers();
    });

    $("#btnAltaUser").click(function(){
        if(confirm("Confirma alta del usuario ingresado?")){
            altaUser();  
            vaciaInputs();
        }        
    });

    $("#nameUser").keyup(function(){
        listoParaAlta();
    });
    $("#passwordUser").keyup(function(){
        listoParaAlta();
    });

    $("#NumeroUser").click(function(){
        order="Numero";
        cargaUsers("CargaDesdeNumero");
    });
    $("#NombreUser").click(function(){
        order="Nombre";
        cargaUsers("CargaDesdeNombre");
    });
    $("#ClaveUser").click(function(){
        order="Clave";
        cargaUsers("CargaDesdeClave");
    });

    $("#btnRegistrarse").click(function(){
        venRegistro=true;
        compVentanas();
        $("#registro").show();
    });

    $("#btnSalirRegistroUser").click(function(){
        venRegistro=false;
        compVentanas();
        $("#registro").hide();        
    });

    $("#btnEntrarDetalleUser").click(function(){
        venDetalle=true;
        compVentanas();
        $("#detalleRegistros").show();
    });

    $("#btnSalirDetalleUser").click(function(){
        venDetalle=false;
        compVentanas();        
        $("#detalleRegistros").hide();
    });
});

function compVentanas(){
    if(venRegistro==false && venDetalle==false){
        $("#divExterior").attr("class","activado");
    }
    else{
        $("#divExterior").attr("class","desactivado");
    }
}

function altaUser(){
    $("#estadoCargaUser").empty();
    $("#estadoCargaUser").html("Esperando respuesta...");
    var objAjax = $.ajax({
        type:"get",
		url:"./servidorUsers.php",
		data:{
			accion:"altaUser",            
            nombre:$("#nameUser").val(),
            clave:$("#passwordUser").val()
        },
        success:function(replyServer,state){
            $("#estadoCargaUser").empty();            
            if(state=="success"){                                
                cargaUsers("CargaDesdeAlta");                
            }
            else{
                $("#estadoCargaUser").html("El usuario no pudo ser dado de alta!");
            }
        }
    });
}

function bajaUser(numeroUser){
    $("#estadoUser").empty();
    $("#estadoUser").html("Esperando respuesta...");
    var objAjax = $.ajax({
        type:"get",
		url:"./servidorUsers.php",
		data:{
			accion:"bajaUser",            
            numero:numeroUser            
        },
        success:function(replyServer,state){
            $("#estadoUser").empty();
            if(state=="success"){                
                $("#estadoUser").html("Se ha realizado la baja del usuario seleccionado!");
                cargaUsers("CargaDesdeBaja");                
            }
            else{
                $("#estadoUser").html("El usuario no pudo ser dado de baja!");
            }
        }
    });
}

function listoParaAlta(){
	if( document.getElementById("nameUser").checkValidity()==true && document.getElementById("passwordUser").checkValidity()==true ){
		$("#btnAltaUser").attr("disabled",false);
	}
	else{
		$("#btnAltaUser").attr("disabled",true);
	}
}

function listoParaLogIn(){
	if( document.getElementById("inpUsuario").checkValidity()==true && document.getElementById("inpClave").checkValidity()==true ){
		$("#btnLogIn").attr("disabled",false);
	}
	else{
		$("#btnLogIn").attr("disabled",true);
	}    
}

function cargaUsers(origen){
    $("#cuerpoTablaUser").empty();    
    $("#cuerpoTablaUser").html("Actualizando tabla. Esperando respuesta...");    
    var objAjax = $.ajax({
        type:"get",
        url:"./servidorUsers.php",
        data:{
            accion:"salidaUsers",
            ordenanza:order
        },
        success:function(replyServer,state){
            $("#cuerpoTablaUser").empty();    
            $("#estadoUser").empty();
            if(state=="success"){                                
                var objUsers = JSON.parse(replyServer);
                objUsers.usuarios.forEach(function(argValor,argIndice){
                    var objTr = document.createElement("tr");

                    var objTd1 = document.createElement("td");
                    objTd1.setAttribute("campo-dato","Numero");
                    objTd1.innerHTML = argValor.Numero;
                    objTr.appendChild(objTd1);

                    var objTd2 = document.createElement("td");
                    objTd2.setAttribute("campo-dato","Nombre");
                    objTd2.innerHTML = argValor.Nombre;
                    objTr.appendChild(objTd2);

                    var objTd3 = document.createElement("td");
                    objTd3.setAttribute("campo-dato","Clave");
                    objTd3.innerHTML = argValor.Clave;
                    objTr.appendChild(objTd3);

                    var objTd4 = document.createElement("td");
                    objTd4.setAttribute("campo-dato","Baja");
                    objTd4.innerHTML = "<button class='btTabla'>Eliminar</button>";
                    objTd4.onclick=function(){					
                        if(confirm("Confirma baja del usuario seleccionado?")){
                            bajaUser(argValor.Numero);						                                                        
                        }										
                    }
                    objTr.appendChild(objTd4);

                    document.getElementById("cuerpoTablaUser").appendChild(objTr);
                });
                if(origen=="Actualizar"){
                    $("#estadoUser").html("Tabla de usuarios actualizada!");   
                }
                if(origen=="CargaDesdeNumero"){
                    $("#estadoUser").html("Tabla de usuarios cargada! Orden: valor de usuario.");   
                }
                if(origen=="CargaDesdeNombre"){
                    $("#estadoUser").html("Tabla de usuarios cargada! Orden: nombre de usuario.");                                           
                }
                if(origen=="CargaDesdeClave"){
                    $("#estadoUser").html("Tabla de usuarios actualizada! Orden: clave de usuario.");                       
                }
                if(origen=="CargaDesdeAlta"){
                    $("#estadoUser").html("Tabla de usuarios actualizada con el nuevo usuario!");   
                }
                if(origen=="CargaDesdeBaja"){
                    $("#estadoUser").html("Tabla de usuarios actualizada luego de realizar la baja solicitada!");   
                }                
            }
            else{
                $("#estadoUser").html("No pudo cargarse la tabla de usuarios!");
            }
        }
    });
}

function borraUsers(){
    $("#cuerpoTablaUser").empty();
    $("#estadoUser").empty();
    $("#estadoUser").html("Tabla vaciada!");
}

function vaciaInputs(){
    $("#nameUser").val("");
    $("#passwordUser").val("");
}