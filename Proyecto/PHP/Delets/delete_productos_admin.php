<?php
require_once('../../Conexion/conn.php');

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    if (!$conn) {
        die(json_encode(["error" => "Error de conexión: " . mysqli_connect_error()]));
    }

    // Obtener el ID del producto a eliminar
    $id_producto = $_POST['id_producto'];

    // Verificar que el ID del producto esté presente
    if (empty($id_producto)) {
        echo json_encode(["error" => "ID del producto es requerido"]);
        exit();
    }

    // Eliminar imagen asociada al producto
    $queryImg = "DELETE FROM Imagen WHERE Id_producto = ?";
    $stmtImg = mysqli_prepare($conn, $queryImg);
    mysqli_stmt_bind_param($stmtImg, 'i', $id_producto);
    mysqli_stmt_execute($stmtImg);
    mysqli_stmt_close($stmtImg);

    // Eliminar el producto
    $query = "DELETE FROM Producto WHERE Id_producto = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_producto);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => "Producto eliminado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al eliminar el producto: " . mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
