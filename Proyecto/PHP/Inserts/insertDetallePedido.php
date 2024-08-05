<?php
require_once('../../Conexion/conn.php');

// Recuperar valores del formulario
$Id_pedido = $_POST["Id_pedido"];
$Id_producto = $_POST["Id_producto"];
$cantidad = $_POST["cantidad"];
$tipo_envio = $_POST["tipo_envio"];
$total_final = $_POST["total"];

// Iniciar la transacción
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

try {
    // Consulta SQL para insertar datos en detalle_pedido
    $sqlDetallePedido = "INSERT INTO detalle_pedido (Id_pedido, Id_producto, Cantidad, Tipo_envio, Total) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlDetallePedido);

    if ($stmt === false) {
        throw new Exception('Error en la preparación de la consulta: ' . mysqli_error($conn));
    }

    // Asociar los parámetros con la consulta
    mysqli_stmt_bind_param($stmt, 'sssss', $Id_pedido, $Id_producto, $cantidad, $tipo_envio, $total_final);

    // Ejecutar la consulta de inserción
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Error al ingresar al sistema: ' . mysqli_stmt_error($stmt));
    }

    // Consulta SQL para actualizar el inventario
    $sqlUpdateInventario = "UPDATE inventario SET cantidad = cantidad - ? WHERE Id_producto = ?";
    $stmtUpdate = mysqli_prepare($conn, $sqlUpdateInventario);

    if ($stmtUpdate === false) {
        throw new Exception('Error en la preparación de la consulta de actualización de inventario: ' . mysqli_error($conn));
    }

    // Asociar los parámetros con la consulta
    mysqli_stmt_bind_param($stmtUpdate, 'is', $cantidad, $Id_producto);

    // Ejecutar la consulta de actualización de inventario
    if (!mysqli_stmt_execute($stmtUpdate)) {
        throw new Exception('Error al actualizar el inventario: ' . mysqli_stmt_error($stmtUpdate));
    }

    // Confirmar la transacción
    mysqli_commit($conn);
    echo "Ingresado al sistema y actualizado el inventario";

    // Cerrar las sentencias preparadas
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmtUpdate);

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    mysqli_rollback($conn);
    echo "No tiene acceso: " . $e->getMessage();
}

mysqli_close($conn);
?>
