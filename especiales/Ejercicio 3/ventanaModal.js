var arregloFamilia = '{"Familia":['+'{"Descripcion":"Tomate"},'+'{"Descripcion":"Banana"},'+'{"Descripcion":"Pera"},'+'{"Descripcion":"Naranja"}'+']}';	
var objJson = JSON.parse(arregloFamilia);

$(document).ready(function(){
	creaOpciones();		
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
});

function creaOpciones() {
	objJson.Familia.forEach(function(argValor, argIndice) {
		var objOpcion = document.createElement("option");			
		objOpcion.setAttribute("value",argValor.Descripcion);
		objOpcion.setAttribute("class","elementoOpcion");
		objOpcion.innerHTML = argValor.Descripcion;
		document.getElementById("detalleFamilia").appendChild(objOpcion);        
	});
}