<?php
require_once('../../../Conexion/conn.php');

$idPedido = $_GET["Id_pedido"];

$query = "SELECT * FROM pedido WHERE Id_pedido = '$idPedido'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $data = [
        "id" => $row["Id_pedido"],
        "sel_idCliente" => $row["Id_cliente"],
        "FechaPedido" => $row["Fecha_pedido"],
        "estado_pedido" => $row["Estado"],
        "total_pedido" => $row["Total"]
    ];
    echo json_encode($data);
} else {
    echo json_encode(array());
}

mysqli_close($conn);
?>
