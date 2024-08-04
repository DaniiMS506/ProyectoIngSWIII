<?php
require_once('../../Conexion/conn.php');

$response = array(); // Crear un arreglo para la respuesta

if (isset($_POST["Id_detalle"])) { 
    $numero_detalle = $_POST["Id_detalle"];
    $numero_detalle = $conn->real_escape_string($numero_detalle);

    //Eliminar relacion de otras tablas
    
        // Ahora puedes eliminar el registro en la tabla principal
        $query = "DELETE FROM detalle_pedido WHERE Id_detalle = '$numero_detalle'";
        
        if ($conn->query($query) === TRUE) {
            $response["success"] = true;
            $response["message"] = "Pedidos eliminados correctamente";
        } else {
            $response["success"] = false;
            $response["message"] = "Error al eliminar el registro principal: " . $conn->error;
        }
    
} else {
    $response["success"] = false;
    $response["message"] = "No se proporcionó el ID del detalle del pedido"; 
}

echo json_encode($response);
?>