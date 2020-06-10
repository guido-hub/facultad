<h1>Texto fuera de las marcas de php</h1>

<?php

echo "<h4>Texto de prueba creado con la sentencia echo</h4>";
echo "<p style='color:green'>Texto adicional<p>";

$miVariable = "Carlos";


echo "Texto sin concatenar <l style='color:blue'>\$miVariable</l> = ";
echo "<br><br>";
echo "Texto concatenado <l style='color:blue'>\$miVariable</l> = " . $miVariable;
echo "<br><br>";
$miVariableBoolean = true;
echo "Variable boolean <l style='color:blue'>\$miVariableBoolean</l> = " . $miVariableBoolean;
echo "<br><br>";
$miVariableBoolean = false;
echo "Variable boolean <l style='color:blue'>\$miVariableBoolean</l> = " . $miVariableBoolean;
echo "<br><br>";
define("MICONSTANTE","valorConstante");
echo "Valor de <l style='color:blue'>MICONSTANTE:</l> " . MICONSTANTE;
echo "<br><br>";
echo "Tipo de <l style='color:blue'>MICONSTANTE:</l>: " . gettype(MICONSTANTE);
echo "<br><br>";
echo "Arreglos:";
$aDatosPersona1 = ["Carlos","Albornoz"];
echo "<l style='color:blue'>\$aDatosPersona1[0]</l> : " . $aDatosPersona1[0];
echo "<br><br>";
echo "<l style='color:blue'>\$aDatosPersona1[1]</l>: " . $aDatosPersona1[1];
echo "<br><br>";
echo "Tipo de <l style='color:blue'>\$aDatosPersona1</l>: " . gettype($aDatosPersona1);
echo "<br><br>";
array_push($aDatosPersona1,"Masculino");
array_push($aDatosPersona1,"Morón");
echo "Todos los elementos: ";
echo "<ol>$aDatosPersona1[0]</ol>";
echo "<ol>$aDatosPersona1[1]</ol>";
echo "<ol>$aDatosPersona1[2]</ol>";
echo "<ol>$aDatosPersona1[3]</ol>";
$aDatosPersona2 = ["Florencia","Sepúlveda","Femenino","Haedo"];
$aDatosPersona3 = ["Laura","Perez","Femenino","Palomar"];
$aDatosPersona4 = ["Hernán","Florentin","Masculino","Castelar"];
$aGruposDePersonas = [];
array_push($aGruposDePersonas,$aDatosPersona1);
array_push($aGruposDePersonas,$aDatosPersona2);
array_push($aGruposDePersonas,$aDatosPersona3);
array_push($aGruposDePersonas,$aDatosPersona4);
echo "<table  style='border: solid 1px;border-collapse:collapse'>";
echo "<tr>";
echo "<th style='background-color:lightgreen;border:solid 1px'>Nombre</th>";
echo "<th style='background-color:lightgreen;border:solid 1px'>Apellido</th>";
echo "<th style='background-color:lightgreen;border:solid 1px'>Sexo</th>";
echo "<th style='background-color:lightgreen;border:solid 1px'>Partido</th>";
echo "</tr>";
foreach($aGruposDePersonas as $solaPersona){
    echo "<tr>";
    echo "<td style='background-color:lightgreen;border:solid 1px'>".$solaPersona[0]."</td>";
    echo "<td style='background-color:lightgreen;border:solid 1px'>".$solaPersona[1]."</td>";
    echo "<td style='background-color:lightgreen;border:solid 1px'>".$solaPersona[2]."</td>";
    echo "<td style='background-color:lightgreen;border:solid 1px'>".$solaPersona[3]."</td>";
    echo "</tr>";
}
echo "</table>";
echo "<h2>Valor en <t style='color:blue'>\$aGruposDePersonas[1][3]</t> : " . $aGruposDePersonas[1][3] . "</h2>";
echo "Cantidad de elementos del array: " . count($aGruposDePersonas);
echo "<h2>Arreglo asociativo:</h2>";
$aAsociativo = ["Nombre" => "Franco", "Edad" => 27, "Nacimiento" => "14/05/1990", "Salario" => 45000 ];
echo "<p>Nombre: " . $aAsociativo['Nombre'] . "</p>";
echo "<p>Edad: " . $aAsociativo['Edad'] . "</p>";
echo "<p>Nacimiento: " . $aAsociativo['Nacimiento'] . "</p>";
echo "<p>Salario: " . $aAsociativo['Salario'] . "</p>";
echo "<p>Cantidad de elementos: " . count($aAsociativo) . "</p>";
echo "Tipo: " . gettype($aAsociativo);
echo "<h4>Expresiones aritméticas: </h4>";
$var1 = 2;
$var2 = 3;
echo "<p>La variable <l style='color:blue'>\$var1</l> tiene el siguiente valor: " . $var1 . "</p>";
echo "<p>La variable <l style='color:blue'>\$var2</l> tiene el siguiente valor: " . $var2 . "</p>";
echo "<p>La variable <l style='color:blue'>\$var1</l> tiene el siguiente tipo: " . gettype($var1) . "</p>";
echo "<p>La variable <l style='color:blue'>\$var2</l> tiene el siguiente tipo: " . gettype($var2) . "</p>";
$var3 = ($var1 + $var2);
$var4 = ($var1 * $var2);
$var5 = ($var1 / $var2);
$var6 = ($var1 - $var2);
echo "<p>La expresión (\$var1 + \$var2) tiene el siguiente valor: " . $var3 . "</p>";
echo "<p>La expresión (\$var1 * \$var2) tiene el siguiente valor: " . $var4 . "</p>";
echo "<p>La expresión (\$var1 / \$var2) tiene el siguiente valor: " . $var5 . "</p>";
echo "<p>La expresión (\$var1 - \$var2) tiene el siguiente valor: " . $var6 . "</p>";
?>