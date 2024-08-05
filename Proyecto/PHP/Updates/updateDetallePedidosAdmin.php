<?php
require_once('../../Conexion/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // Obtener los datos del formulario
    $Id_detalle = $_POST['Id_detalle'];
    $sel_idPedido = $_POST['sel_idPedido']; 
    $sel_idProducto = $_POST['sel_idProducto']; 
    $cantidad = $_POST['cantidad']; 
    $tipo_envio = $_POST['tipo_envio']; 
    $total = $_POST['total']; 

    // Verificar que todos los datos necesarios estén presentes
    if (empty($Id_detalle) || empty($sel_idPedido) || empty($sel_idProducto) || empty($cantidad) || empty($tipo_envio) || empty($total)) {
        die("Todos los campos son obligatorios");
    }

    // Iniciar la transacción
    mysqli_begin_transaction($conn);

    try {
        // Construir la consulta SQL para actualizar detalle_pedido
        $query = "UPDATE detalle_pedido SET Id_pedido = '$sel_idPedido', Id_producto = '$sel_idProducto', Cantidad = '$cantidad', Tipo_envio = '$tipo_envio', Total = '$total' WHERE Id_detalle = '$Id_detalle'";
        
        // Ejecutar la consulta SQL para actualizar detalle_pedido
        if (!mysqli_query($conn, $query)) {
            throw new Exception("Error al guardar cambios en detalle_pedido: " . mysqli_error($conn));
        }

        // Construir la consulta SQL para actualizar inventario
        $query_inventario = "UPDATE inventario SET cantidad = cantidad - '$cantidad' WHERE Id_producto = '$sel_idProducto'";

        // Ejecutar la consulta SQL para actualizar inventario
        if (!mysqli_query($conn, $query_inventario)) {
            throw new Exception("Error al actualizar inventario: " . mysqli_error($conn));
        }

        // Confirmar la transacción
        mysqli_commit($conn);
        echo "Cambios guardados correctamente";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($conn);
        echo $e->getMessage();
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
