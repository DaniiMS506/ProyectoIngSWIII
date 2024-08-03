<?php
require_once('../../Conexion/conn.php');

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    if (!$conn) {
        die(json_encode(["error" => "Error de conexión: " . mysqli_connect_error()]));
    }

    // Obtener los datos del formulario
    $id_inventario = $_POST['Id_inventario'];
    $id_producto = $_POST['Id_producto'];
    $cantidad = $_POST['Cantidad'];

    // Verificar que todos los datos necesarios estén presentes
    if (empty($id_inventario) || empty($id_producto) || empty($cantidad)) {
        echo json_encode(["error" => "Todos los campos son obligatorios"]);
        exit();
    }

    // Actualizar datos del inventario
    $query = "UPDATE Inventario SET Id_producto = ?, Cantidad = ? WHERE Id_inventario = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iii', $id_producto, $cantidad, $id_inventario);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => "Inventario actualizado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al guardar cambios: " . mysqli_error($conn)]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(["error" => "Método de solicitud no válido"]);
}
