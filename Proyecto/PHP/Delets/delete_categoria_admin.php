<?php
require_once('../../Conexion/conn.php');

$response = array(); // Crear un arreglo para la respuesta

if (isset($_POST["Id_categoria"])) {
    $numero_categoria = $_POST["Id_categoria"];
    $numero_categoria = $conn->real_escape_string($numero_categoria);

    //Eliminar relacion de otras tablas
    $query_relacionada_1 = "DELETE FROM categoria WHERE Id_categoria = '$numero_categoria'";

    if ($conn->query($query_relacionada_1) === TRUE) {
        // Eliminar el registro en la tabla principal
        $query = "DELETE FROM categoria WHERE Id_categoria = '$numero_categoria'";

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
