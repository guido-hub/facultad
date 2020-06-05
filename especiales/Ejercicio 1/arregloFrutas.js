var arregloFamilia = '{"Familia":['+'{"Descripcion":"Tomate"},'+'{"Descripcion":"Banana"},'+'{"Descripcion":"Pera"},'+'{"Descripcion":"Naranja"}'+']}';	
var objJson = JSON.parse(arregloFamilia);

$(document).ready(function(){
	creaOpciones();		
})

function creaOpciones() {
	objJson.Familia.forEach(function(argValor, argIndice) {
		var objOpcion = document.createElement("option");			
		objOpcion.setAttribute("value",argValor.Descripcion);
		objOpcion.setAttribute("class","elementoOpcion");
		objOpcion.innerHTML = argValor.Descripcion;
		document.getElementById("detalleFamilia").appendChild(objOpcion);        
	});
}