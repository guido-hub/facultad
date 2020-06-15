$(document).ready(function(){	    
    $("#flechita").click(function(){
        $("#resultado").empty();
        $("#resultado").addClass("estiloRecibiendo");
        $("#resultado").html("<h2>Esperando respuesta...</h2>");
        $("#estado").empty();
        $("#estado").append("<h2>Estado requerimiento: </h2>");

        $.ajax({
            type: "post",
            url: "./encriptacion.php",
            data:{clave: $("#clave").val()},
            success:function(respuestaDelServer, estado){
                $("#resultado").removeClass("estiloRecibiendo");
                $("#resultado").html("<h2>Resultado:</h2><h4>"+respuestaDelServer+"</h4>");
                $("#estado").append("<h4>"+estado+"</h4>");
            }
        });
    });
});