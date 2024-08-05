<?php
require_once('../../Conexion/conn.php');

// Recuperar valores del formulario
$Id_cliente = $_REQUEST["Id_cliente"];
$fecha_pedido = $_REQUEST["fecha_pedido"];
$estado = $_REQUEST["estado"];

// Consulta SQL para insertar datos
$sqlPedido = "INSERT INTO pedido (Id_cliente, Fecha_pedido, estado) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sqlPedido);

// Verificar si la preparación de la sentencia fue exitosa
if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . mysqli_error($conn));
}

// Asociar los parámetros con la consulta
mysqli_stmt_bind_param($stmt, 'sss', $Id_cliente, $fecha_pedido, $estado);

try {
    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        echo "Ingresado al sistema";
    } else {
        echo "Error al ingresar al sistema: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} catch (mysqli_sql_exception $e) {
    echo "No tiene acceso: " . $e->getMessage();
}

mysqli_close($conn);
