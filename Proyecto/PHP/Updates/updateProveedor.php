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
    $id_proveedor = $_POST['Id_proveedor'];
    $nombre = $_POST['Nombre'];
    $direccion = $_POST['Direccion'];
    $telefono = $_POST['Telefono'];
    $email = $_POST['Email'];

    // Verificar que todos los datos necesarios estén presentes
    if (empty($id_proveedor) || empty($nombre) || empty($direccion) || empty($telefono) || empty($email)) {
        echo json_encode(["error" => "Todos los campos son obligatorios"]);
        exit();
    }

    // Actualizar datos del inventario
    $query = "UPDATE proveedor SET Nombre = ?, Direccion = ?, Telefono = ?, Email = ? WHERE Id_proveedor = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssisi', $nombre, $direccion, $telefono, $email, $id_proveedor);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => "Proveedor actualizado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al guardar cambios: " . mysqli_error($conn)]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(["error" => "Método de solicitud no válido"]);
}
