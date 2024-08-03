<?php
require_once('../../../Conexion/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la conexión a la base de datos
    if (!$conn) {
        die(json_encode(["error" => "Error de conexión: " . mysqli_connect_error()]));
    }

    $id_producto = $_POST['id_producto'];

    if (empty($id_producto)) {
        echo json_encode(["error" => "ID del producto es obligatorio"]);
        exit();
    }

    $query = "SELECT p.Id_producto, p.Nombre_producto, p.Precio, p.Descripcion, p.Fecha_expiracion, p.Id_categoria, c.Nombre_categoria
                FROM Producto p
                INNER JOIN Categoria c ON p.Id_categoria = c.Id_categoria
                WHERE p.Id_producto = '$id_producto'";

    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Producto no encontrado"]);
    }

    mysqli_close($conn);
}
