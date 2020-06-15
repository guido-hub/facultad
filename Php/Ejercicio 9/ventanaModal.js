$(document).ready(function(){	
	$("#divModal").hide();
	$("#divExterno").attr("class","externoActivado");

	$("#btnModal").click(function(){
		$("#divModal").show();		
		$("#divExterno").attr("class","externoDesactivado");
	});
	
	$("#btnSalir").click(function(){
		$("#divModal").hide();
		$("#divExterno").attr("class","externoActivado");
    });
        
    $("#envio").click(function(){      
        $("#resultado").empty();  
        $("#resultado").addClass("estiloRecibiendo");
        $("#resultado").html("<h4>Esperando respuesta...</h4>");        
        
        $.ajax({
            type: "post",
            url: "./respuesta.php",
            data:{clave: $("#idUsuario").val(), login: $("#login").val(), apellido: $("#apellido").val(), nombres: $("#nombres").val(), fechaNacimiento: $("#fechaNacimiento").val()},
            success:function(respuestaDelServer, estado){                
                $("#resultado").removeClass("estiloRecibiendo");
                $("#resultado").html("<h4>Resultado de la transformacion a JSON en el servidor:</h4>"+respuestaDelServer);                
            }
        });
    });
});