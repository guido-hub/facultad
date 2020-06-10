<?php
echo "<h1>Variables del servidor</h1>";
echo "<table style='border-collapse:collapse'>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>SERVER_ADDR</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['SERVER_ADDR']."</td></tr>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>SERVER_PORT</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['SERVER_PORT']."</td></tr>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>SERVER_NAME</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['SERVER_NAME']."</td></tr>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>DOCUMENT_ROOT</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['DOCUMENT_ROOT']."</td></tr>";
echo "</table>";

echo "<h1>Variables del cliente</h1>";
echo "<table style='border-collapse:collapse'>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>REMOTE_ADDR</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['REMOTE_ADDR']."</td></tr>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>REMOTE_PORT</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['REMOTE_PORT']."</td></tr>";
echo "</table>";


echo "<h1>Variables de requerimiento</h1>";
echo "<table style='border-collapse:collapse'>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>SCRIPT_NAME</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['SCRIPT_NAME']."</td></tr>";
echo "<tr><td style='border:solid 1px; background-color:lightgrey'>REQUEST_METHOD</td>";
echo "<td style='border:solid 1px; background-color:lightgrey'>".$_SERVER['REQUEST_METHOD']."</td></tr>";
echo "</table>";

echo "<h1>TODAS</h1>";
echo "<table style='border-collapse:collapse'>";
foreach($_SERVER as $key_name => $key_value){
    echo "<tr><td style='border:solid 1px; background-color:lightgrey'>".$key_name."</td>";
    echo "<td style='border:solid 1px; background-color:lightgrey'>".$key_value."</td></tr>";
}
echo "</table>";
?>
