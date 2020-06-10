<?php
echo "<h1>Array asociativo</h1>";
$aAsociativo1 = ["Nombre" => "Franco", "Edad" => 18, "Nacimiento" => "11/05/1990", "Salario" => 45000 ];
$aAsociativo2 = ["Nombre" => "Laura", "Edad" => 24, "Nacimiento" => "28/09/1990", "Salario" => 20000 ];
$aAsociativo3 = ["Nombre" => "Marcelo", "Edad" => 32, "Nacimiento" => "07/10/1990", "Salario" => 60000 ];
$aAsociativo4 = ["Nombre" => "Jorge", "Edad" => 49, "Nacimiento" => "14/02/1990", "Salario" => 30000 ];
$aGruposDePersonas = [];
array_push($aGruposDePersonas,$aAsociativo1);
array_push($aGruposDePersonas,$aAsociativo2);
array_push($aGruposDePersonas,$aAsociativo3);
array_push($aGruposDePersonas,$aAsociativo4);
echo "<table  style='border: solid 1px;border-collapse:collapse'>";
echo "<tr>";
echo "<th style='background-color:lightblue;border:solid 1px'>Nombre</th>";
echo "<th style='background-color:lightblue;border:solid 1px'>Edad</th>";
echo "<th style='background-color:lightblue;border:solid 1px'>Nacimiento</th>";
echo "<th style='background-color:lightblue;border:solid 1px'>Salario</th>";
echo "</tr>";
foreach($aGruposDePersonas as $solaPersona){
    echo "<tr>";
    echo "<td style='background-color:lightblue;border:solid 1px'>".$solaPersona['Nombre']."</td>";
    echo "<td style='background-color:lightblue;border:solid 1px'>".$solaPersona['Edad']."</td>";
    echo "<td style='background-color:lightblue;border:solid 1px'>".$solaPersona['Nacimiento']."</td>";
    echo "<td style='background-color:lightblue;border:solid 1px'>".$solaPersona['Salario']."</td>";
    echo "</tr>";
}
echo "</table>";
echo "La longitud del arreglo es: " . count($aGruposDePersonas);
?>