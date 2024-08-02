<?php
require_once('../../Conexion/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del POST
    $idProducto = $_POST['Id_producto'];
    $cantidad = $_POST['Cantidad'];

    if ($idProducto && $cantidad) {
        // Preparar y ejecutar la consulta de inserción
        $sql = "INSERT INTO Inventario (Id_producto, Cantidad) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $idProducto, $cantidad);

        if ($stmt->execute()) {
            // Obtener el nombre del producto insertado
            $sqlProducto = "SELECT Nombre_producto FROM Producto WHERE Id_producto = ?";
            $stmtProducto = $conn->prepare($sqlProducto);
            $stmtProducto->bind_param("i", $idProducto);
            $stmtProducto->execute();
            $resultProducto = $stmtProducto->get_result();
            $producto = $resultProducto->fetch_assoc();

            // Crear la respuesta JSON
            $response = [
                'Nombre_producto' => $producto['Nombre_producto'],
                'Cantidad' => $cantidad
            ];

            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'Error al insertar en la base de datos']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Datos incompletos']);
    }
}

// Cerrar conexión
$conn->close();
