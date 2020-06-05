var arregloFamilia2 = '{"Familia":['+'{"Descripcion":"Tomate"},'+'{"Descripcion":"Banana"},'+'{"Descripcion":"Pera"},'+'{"Descripcion":"Naranja"}'+']}';	
var objJson2 = JSON.parse(arregloFamilia2);

$(document).ready(function(){
    creaOpciones();		
	$("#divModal").hide();
	$("#formExterno").attr("class","activado");

	$("#btnModal").click(function(){
		$("#divModal").show();		
		$("#formExterno").attr("class","desactivado");
	});
	
	$("#btnSalir").click(function(){
		$("#divModal").hide();
		$("#formExterno").attr("class","activado");
	});
});

function creaOpciones() {
	objJson2.Familia.forEach(function(argValor, argIndice) {
		var objOpcion = document.createElement("option");			
		objOpcion.setAttribute("value",argValor.Descripcion);
		objOpcion.setAttribute("class","elementoOpcion");
		objOpcion.innerHTML = argValor.Descripcion;
		document.getElementById("detalleFamilia").appendChild(objOpcion);        
	});
}