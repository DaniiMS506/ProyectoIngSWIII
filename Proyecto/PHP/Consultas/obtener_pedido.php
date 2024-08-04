<?php
require_once('../../Conexion/conn.php');

$sql = "SELECT Id_pedido FROM pedido";
$result = mysqli_query($conn, $sql);

$pedido = array();
while ($row = mysqli_fetch_assoc($result)) {
    $pedido[] = $row;
}

echo json_encode($pedido);
?>
