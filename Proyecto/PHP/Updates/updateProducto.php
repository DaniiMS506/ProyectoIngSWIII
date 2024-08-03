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
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['NombreProducto'];
    $descripcion = $_POST['Descripcion'];
    $precio = $_POST['Precio'];
    $fecha_expiracion = $_POST['Fecha_expiracion'];
    $id_categoria = $_POST['Id_categoria'];

    // Verificar que todos los datos necesarios estén presentes
    if (empty($id_producto) || empty($nombre) || empty($descripcion) || empty($precio) || empty($fecha_expiracion) || empty($id_categoria)) {
        echo json_encode(["error" => "Todos los campos son obligatorios"]);
        exit();
    }

    // Actualizar datos del producto
    $query = "UPDATE Producto SET Nombre_producto = ?, Descripcion = ?, Precio = ?, Fecha_expiracion = ?, Id_categoria = ? WHERE Id_producto = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssdssi', $nombre, $descripcion, $precio, $fecha_expiracion, $id_categoria, $id_producto);

    if (mysqli_stmt_execute($stmt)) {
        // Verificar si se subió una nueva imagen
        if (isset($_FILES['ImagenProd']) && $_FILES['ImagenProd']['error'] == UPLOAD_ERR_OK) {
            $imgData = file_get_contents($_FILES['ImagenProd']['tmp_name']);

            // Actualizar imagen en la base de datos
            $queryImg = "UPDATE Imagen SET Imagen = ? WHERE Id_producto = ?";
            $stmtImg = mysqli_prepare($conn, $queryImg);
            mysqli_stmt_bind_param($stmtImg, 'bi', $imgData, $id_producto);
            mysqli_stmt_send_long_data($stmtImg, 0, $imgData);
            mysqli_stmt_execute($stmtImg);
            mysqli_stmt_close($stmtImg);
        }

        echo json_encode(["success" => "Cambios guardados correctamente"]);
    } else {
        echo json_encode(["error" => "Error al guardar cambios: " . mysqli_error($conn)]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
