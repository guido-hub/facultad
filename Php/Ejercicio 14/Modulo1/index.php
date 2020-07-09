<?php
include("./proteccion.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Php</title>	
	<meta charset="utf-8">			
	<script type="text/javascript" src="../../jquery-3.5.1.min.js"></script>		
	<script type="text/javascript" src="./JSyJQ.js"></script>	
	<link rel="stylesheet" type="text/css" href="./estilo.css">
</head>	

<body>

	<div class="activado" id="divExterno">
		<header>
			<h1>Visitas al Gimnasio</h1>	
			<input type="text" id="orden" value="ID">
			<button id="cargaInfo" type="button">Cargar información</button>
			<button id="vaciaInfo" type="button">Vaciar información</button>
			<button id="btnVentanaModalFormAlta" type="button">Alta Visita</button>
			<button id="btnCerrarSesion" type="button">Cerrar Sesion</button>
		</header>	
		<table>
			<thead>
			<tr>
				<th campo-dato='ID' id="ID">ID</th>
				<th campo-dato='Nombre' id="Nombre">Nombre</th>
				<th campo-dato='Apellido' id="Apellido">Apellido</th>
				<th campo-dato='Actividad' id="Actividad">Actividad</th>
				<th campo-dato='Fecha' id="Fecha">Fecha</th>
				<th campo-dato='Modificación' id="Modificación">Modificación</th>
				<th campo-dato='Baja' id="Baja">Baja</th>
			</tr>
			<tr>
				<th campo-dato='ID'><input type="number" id="inpID"></th>
				<th campo-dato='Nombre'><input type="text" id="inpNombre"></th>
				<th campo-dato='Apellido'><input type="text" id="inpApellido"></th>
				<th campo-dato='Actividad'><input type="text"id="inpActividad"></th>
				<th campo-dato='Fecha'><input type="date" id="inpFecha"></th>
			</tr>
			</thead>
			<tbody id="cuerpoTabla">
	
			</tbody>
			<tfoot>
				<th campo-dato='ID'>Totales</th>
				<th campo-dato='Nombre'>Nombre</th>
				<th campo-dato='Apellido'>Apellido</th>
				<th campo-dato='Actividad'>Actividad</th>
				<th campo-dato='Fecha'>Fecha</th>
			</tfoot>
		</table>
		<footer>
			<h2>Cantidad Registros: <l id="registros"></l></h2>
			<h1>Pie del formulario</h1>			
		</footer>
	</div>	

	<div class="modal1" id="divModalFormAlta" hidden="hidden">
		<div class="barra"><button class="ventana" id="btnSalirFormAlta">X</button></div>		
		<header class="interno">
			<h1>Formulario para alta - Maestro de Visitas</h1>	
		</header>
		<div class="central">
			<label class="interno">ID Visita:</label>
			<input class="interno" id="idVisitaFormAlta" type="number" name="numero" readonly>
			<label class="interno">Nombre:</label>
			<input class="interno" id="nombreVisitaFormAlta" type="text" name="nombre" maxlength="15" required="required">
			<label class="interno">Apellido:</label>
			<input class="interno" id="apellidoVisitaFormAlta" type="text" name="apellido" maxlength="15" required="required">			
		</div>
		<div class="central">
			<label class="interno">Actividad:</label>
			<select class="interno" id="detalleActividadFormAlta" name="actividad" required="required"></select>
			<label class="interno">Fecha:</label>
			<input class="interno" id="fechaVisitaFormAlta" type="date" name="fecha" maxlength="10" required="required">									
			<button id="btnEnviarFormAlta" class="form">ENVIAR</button>
		</div>
		<footer class="interno">
			<h1>Pie del formulario</h1>
		</footer>		
	</div>

	<div class="modal2" id="divModalFormModi" hidden="hidden">
		<div class="barra"><button class="ventana" id="btnSalirFormModi">X</button></div>		
		<header class="interno">
			<h1>Formulario para modificación - Maestro de Visitas</h1>	
		</header>
		<div class="central">
			<label class="interno">ID Visita:</label>
			<input class="interno" id="idVisitaFormModi" type="number" name="numero" readonly>
			<label class="interno">Nombre:</label>
			<input class="interno" id="nombreVisitaFormModi" type="text" name="nombre" maxlength="15" required="required">
			<label class="interno">Apellido:</label>
			<input class="interno" id="apellidoVisitaFormModi" type="text" name="apellido" maxlength="15" required="required">			
		</div>
		<div class="central">
			<label class="interno">Actividad:</label>
			<select class="interno" id="detalleActividadFormModi" name="actividad" required="required"></select>
			<label class="interno">Fecha:</label>
			<input class="interno" id="fechaVisitaFormModi" type="date" name="fecha" maxlength="10" required="required">									
			<button id="btnEnviarFormModi" class="form">ENVIAR</button>
		</div>
		<footer class="interno">
			<h1>Pie del formulario</h1>
		</footer>		
	</div>

	<div class="modal3" id="divModalFormResp" hidden="hidden">
		<div class="barra"><button class="ventana" id="btnSalirFormResp">X</button></div>	
		<l id="respuesta" class="reply"></l>
	</div>

</body>

</html>