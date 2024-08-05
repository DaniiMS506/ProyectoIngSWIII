<?php
require_once('../../Conexion/conn.php');

$sql = "SELECT Id_cliente, Nombre FROM Cliente";
$result = mysqli_query($conn, $sql);

$clientes = array();
while ($row = mysqli_fetch_assoc($result)) {
    $clientes[] = $row;
}

echo json_encode($clientes);
?>
