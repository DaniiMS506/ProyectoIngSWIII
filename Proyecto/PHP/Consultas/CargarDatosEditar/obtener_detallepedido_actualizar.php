<?php
require_once('../../../Conexion/conn.php');

$idDetalle = $_GET["Id_detalle"];

$query = "SELECT * FROM detalle_pedido WHERE Id_detalle = '$idDetalle'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $data = [
        "id" => $row["Id_detalle"],
        "sel_idPedido" => $row["Id_pedido"],
        "sel_idProducto" => $row["Id_producto"],
        "cantidad" => $row["Cantidad"],
        "tipo_envio" => $row["Tipo_envio"],
        "precio_unitario" => $row["Precio_unitario"]
    ];
    echo json_encode($data);
} else {
    echo json_encode(array());
}

mysqli_close($conn);
?>
