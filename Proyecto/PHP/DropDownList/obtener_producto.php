<?php
require_once('../../Conexion/conn.php');

$sql = "SELECT Id_producto, Nombre_producto FROM producto";
$result = mysqli_query($conn, $sql);

$producto = array();
while ($row = mysqli_fetch_assoc($result)) {
    $producto[] = $row;
}

echo json_encode($producto);
?>
