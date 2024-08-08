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
    $id_categoria = $_POST['Id_categoria'];
    $nombre = $_POST['Nombre_categoria'];
    $descripcion = $_POST['Descripcion'];

    // Verificar que todos los datos necesarios estén presentes
    if (empty($id_categoria) || empty($nombre) || empty($descripcion)) {
        echo json_encode(["error" => "Todos los campos son obligatorios"]);
        exit();
    }

    // Actualizar datos del inventario
    $query = "UPDATE categoria SET Nombre_categoria = ?, Descripcion = ? WHERE Id_categoria = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssi', $nombre, $descripcion, $id_categoria);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => "Categoria actualizado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al guardar cambios: " . mysqli_error($conn)]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(["error" => "Método de solicitud no válido"]);
}
