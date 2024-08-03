<?php
require_once('../../Conexion/conn.php');

$response = array(); // Crear un arreglo para la respuesta

if (isset($_POST["Id_inventario"])) {
    $numero_inventario = $_POST["Id_inventario"];
    $numero_inventario = $conn->real_escape_string($numero_inventario);

    //Eliminar relacion de otras tablas
    $query_relacionada_1 = "DELETE FROM inventario WHERE Id_inventario = '$numero_inventario'";

    if ($conn->query($query_relacionada_1) === TRUE) {
        // Eliminar el registro en la tabla principal
        $query = "DELETE FROM inventario WHERE Id_inventario = '$numero_inventario'";

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
