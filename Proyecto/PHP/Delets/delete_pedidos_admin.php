<?php
require_once('../../Conexion/conn.php');

$response = array(); // Crear un arreglo para la respuesta

if (isset($_POST["Id_pedido"])) { 
    $numero_pedido = $_POST["Id_pedido"];
    $numero_pedido = $conn->real_escape_string($numero_pedido);

    //Eliminar relacion de otras tablas
    $query_relacionada_1 = "DELETE FROM detalle_pedido WHERE Id_pedido = '$numero_pedido'";
    
    if ($conn->query($query_relacionada_1) === TRUE) {
        // Ahora puedes eliminar el registro en la tabla principal
        $query = "DELETE FROM pedido WHERE Id_pedido = '$numero_pedido'";
        
        if ($conn->query($query) === TRUE) {
            $response["success"] = true;
            $response["message"] = "Pedidos eliminados correctamente";
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
    $response["message"] = "No se proporcionó el ID del pedido"; 
}

echo json_encode($response);
?>