<?php
require_once('../../Conexion/conn.php');

$response = array(); // Crear un arreglo para la respuesta

if (isset($_POST["Id_proveedor"])) {
    $numero_proveedor = $_POST["Id_proveedor"];
    $numero_proveedor = $conn->real_escape_string($numero_proveedor);

    //Eliminar relacion de otras tablas
    $query_relacionada_1 = "DELETE FROM proveedor WHERE Id_proveedor = '$numero_proveedor'";

    if ($conn->query($query_relacionada_1) === TRUE) {
        // Eliminar el registro en la tabla principal
        $query = "DELETE FROM proveedor WHERE Id_proveedor = '$numero_proveedor'";

        if ($conn->query($query) === TRUE) {
            $response["success"] = true;
            $response["message"] = "Registros eliminados correctamente";
        } else {
            $response["success"] = false;
            $response["message"] = "Error al eliminar el registro principal: " . $conn->error;
        }
    } else {
        $response["success"] = false;
        $response["message"] = "Error al eliminar registros en las tablas relacionadas: " . $conn->error;
    }
} else {
    $response["success"] = false;
    $response["message"] = "No se proporcionó el ID del artículo";
}

echo json_encode($response);
