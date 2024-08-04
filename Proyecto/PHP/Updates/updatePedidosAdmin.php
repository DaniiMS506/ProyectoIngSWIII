<?php
require_once('../../Conexion/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // Obtener los datos del formulario
    $Id_pedido = $_POST['Id_pedido'];
    $sel_idCliente = $_POST['sel_idCliente']; 
    $FechaPedido = $_POST['FechaPedido']; 
    $estado_pedido = $_POST['estado_pedido']; 
    $total = $_POST['total_pedido']; 


    // Verificar que todos los datos necesarios estén presentes
    if (empty($Id_pedido) || empty($sel_idCliente) || empty($FechaPedido) || empty($estado_pedido) || empty($total)) {
        die("Todos los campos son obligatorios");
    }

    // Construir la consulta SQL
    $query = "UPDATE pedido SET Id_Cliente = '$sel_idCliente', Fecha_pedido = '$FechaPedido', Estado = '$estado_pedido', Total = '$total' WHERE Id_pedido = '$Id_pedido'";

    // Ejecutar la consulta SQL
    if (mysqli_query($conn, $query)) {
        echo "Cambios guardados correctamente";
    } else {
        echo "Error al guardar cambios: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
