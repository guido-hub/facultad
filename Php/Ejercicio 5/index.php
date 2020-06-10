<?php
echo "<h1>Variables objeto de PHP. Objeto linea de pedido</h1>";
$objLineaPedido1 = new stdclass;
$objLineaPedido1->codArticulo = "aa0001";
$objLineaPedido1->descArticulo = "Manzana";
$objLineaPedido1->cantidad = 15;
$objLineaPedido1->preUnitario = 70;

echo "<h2>Variable <l style='color:blue'>\$objLineaPedido1</l></h2>";
echo "<p>Código de artículo: " . $objLineaPedido1->codArticulo . "</p>";
echo "<p>Descripción del artículo: " . $objLineaPedido1->descArticulo . "</p>";
echo "<p>Cantidad: " . $objLineaPedido1->cantidad . "</p>";
echo "<p>Precio unitario: " . $objLineaPedido1->preUnitario . "</p>";
echo "<h2>Tipo de <l style='color:blue'>\$objLineaPedido1</l>: " . gettype($objLineaPedido1) . "</h2>";
echo "<h2>Definición de arreglo de pedidos: </h2>";
$objLineaPedido2 = new stdclass;
$objLineaPedido2->codArticulo = "aa0002";
$objLineaPedido2->descArticulo = "Banana";
$objLineaPedido2->cantidad = 10;
$objLineaPedido2->preUnitario = 90;

$objLineaPedido3 = new stdclass;
$objLineaPedido3->codArticulo = "aa0003";
$objLineaPedido3->descArticulo = "Pera";
$objLineaPedido3->cantidad = 20;
$objLineaPedido3->preUnitario = 60;

$objLineaPedido4 = new stdclass;
$objLineaPedido4->codArticulo = "aa0004";
$objLineaPedido4->descArticulo = "Kiwi";
$objLineaPedido4->cantidad = 15;
$objLineaPedido4->preUnitario = 110;

$lineasPedido = [];
array_push($lineasPedido, $objLineaPedido1);
array_push($lineasPedido, $objLineaPedido2);
array_push($lineasPedido, $objLineaPedido3);
array_push($lineasPedido, $objLineaPedido4);
echo "<h2 style='color:blue'>\$lineasPedido</h2>";
echo "<h2>Tabulación del arreglo <l style='color:blue'>\$lineasPedido</l>. </h2>";
echo "<h2>Recorrido del arreglo de lineas y tabulación con HTML:</h2>";
echo "<table style='border-collapse:collapse'>";
echo "<th style='border:solid 1px;background-color:lightgreen'>Código</th>";
echo "<th style='border:solid 1px;background-color:lightgreen'>Descripción</th>";
echo "<th style='border:solid 1px;background-color:lightgreen'>Cantidad</th>";
echo "<th style='border:solid 1px;background-color:lightgreen'>Precio Unitario</th>";
foreach($lineasPedido as $objLinea){
    echo "<tr><td style='border:solid 1px;background-color:lightgreen'>" . $objLinea->codArticulo .  "</td>";
    echo     "<td style='border:solid 1px;background-color:lightgreen'>" . $objLinea->descArticulo . "</td>";
    echo     "<td style='border:solid 1px;background-color:lightgreen'>" . $objLinea->cantidad .     "</td>";
    echo     "<td style='border:solid 1px;background-color:lightgreen'>" . $objLinea->preUnitario .  "</td></tr>";
}
echo "</table>";
echo "<p>Cantidad de renglones: " . count($lineasPedido) . "</p>";
$objLineasPedido = new stdclass();
$objLineasPedido->lineasPedido=$lineasPedido;
$objLineasPedido->cantidadLineas=count($lineasPedido);
echo "<h2>Producción del objeto <l style='color:blue'>\$objLineasPedido</l> con dos atributos array lineasPedido y cantidadLineas</h2>";
echo "<p>Cantidad de lineas: ". $objLineasPedido->cantidadLineas ."</p>";
echo "<h2>Producción de una JSON <l style='color:blue'>jsonlineas</l>:</h2>";
$jsonLineasPedido=json_encode($objLineasPedido);
echo $jsonLineasPedido;
?>