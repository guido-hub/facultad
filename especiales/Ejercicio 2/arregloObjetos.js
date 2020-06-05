var arregloFamilia = '{"Familia":['+'{"Descripcion":"Tomate","Peso":"20","Medida":"Kg","Precio":"$40"},'+'{"Descripcion":"Banana","Peso":"2","Medida":"Kg","Precio":"$90"},'+'{"Descripcion":"Pera","Peso":"10","Medida":"Kg","Precio":"$60"},'+'{"Descripcion":"Naranja","Peso":"15","Medida":"Kg","Precio":"$75"}'+']}';	
objJson = JSON.parse(arregloFamilia);

$(document).ready(function(){	
	$("#cargaInfo").click(function(){
		creaTabla();
	});
	$("#vaciaInfo").click(function(){
		borraTabla();
	});
});

function creaTabla() {
	objJson.Familia.forEach(function(argValor, argIndice) {
		var objTr = document.createElement("tr");		

		var objTd1 = document.createElement("td");
		objTd1.setAttribute("campo-dato","Descripcion");
		objTd1.innerHTML = argValor.Descripcion;
		objTr.appendChild(objTd1);

		var objTd2 = document.createElement("td");
		objTd2.setAttribute("campo-dato","Peso");
		objTd2.innerHTML = argValor.Peso;
		objTr.appendChild(objTd2);

		var objTd3 = document.createElement("td");
		objTd3.setAttribute("campo-dato","UM");
		objTd3.innerHTML = argValor.Medida;
		objTr.appendChild(objTd3);

		var objTd4 = document.createElement("td");
		objTd4.setAttribute("campo-dato","Precio");
		objTd4.innerHTML = argValor.Precio;
		objTr.appendChild(objTd4);

		document.getElementById("cuerpoTabla").appendChild(objTr);
	});
}

function borraTabla(){
	$("#cuerpoTabla").empty();
};