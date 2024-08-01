<?php
require_once('../../Conexion/conn.php');

// Establecer el tipo de contenido como JSON
header('Content-Type: application/json');

try {
    // Recoger datos del POST
    $nombreProducto = $_POST['Nombre_producto'];
    $descripcion = $_POST['Descripcion'];
    $precio = $_POST['Precio'];
    $fechaExpiracion = $_POST['Fecha_expiracion'];
    $idCategoria = $_POST['Id_categoria'];

    // Validar y limpiar la fecha
    $fechaExpiracion = date('Y-m-d', strtotime($fechaExpiracion));

    // Insertar datos en la base de datos
    $sql = "INSERT INTO Producto (Nombre_producto, Descripcion, Precio, Fecha_expiracion, Id_categoria) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdsi', $nombreProducto, $descripcion, $precio, $fechaExpiracion, $idCategoria);

    if (mysqli_stmt_execute($stmt)) {
        $lastInsertedId = mysqli_insert_id($conn);

        // Manejo de la imagen
        $imagen = null;
        if (isset($_FILES['ImagenProd']['tmp_name']) && $_FILES['ImagenProd']['error'] === UPLOAD_ERR_OK) {
            $imagen = file_get_contents($_FILES['ImagenProd']['tmp_name']);
        }

        if ($imagen) {
            // Insertar imagen en la base de datos
            $sqlImagen = "INSERT INTO Imagen (Id_producto, Imagen) VALUES (?, ?)";
            $stmtImagen = mysqli_prepare($conn, $sqlImagen);
            mysqli_stmt_bind_param($stmtImagen, 'ib', $lastInsertedId, $imagen);
            mysqli_stmt_send_long_data($stmtImagen, 1, $imagen);
            mysqli_stmt_execute($stmtImagen);
        }

        // Obtener la fila recién insertada
        $selectQuery = "SELECT * FROM Producto WHERE Id_producto = ?";
        $selectStmt = mysqli_prepare($conn, $selectQuery);
        mysqli_stmt_bind_param($selectStmt, 'i', $lastInsertedId);
        mysqli_stmt_execute($selectStmt);
        $result = mysqli_stmt_get_result($selectStmt);

        if ($result) {
            $insertedRow = mysqli_fetch_assoc($result);
            echo json_encode($insertedRow);
        } else {
            echo json_encode(['error' => 'No se pudo recuperar el producto']);
        }
    } else {
        echo json_encode(['error' => 'Error al insertar el producto']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

// Cerrar conexión
mysqli_close($conn);
