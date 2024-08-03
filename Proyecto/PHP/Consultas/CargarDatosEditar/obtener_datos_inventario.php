<?php
require_once('../../../Conexion/conn.php');

$id_inventario = $_POST['id_inventario'];

// Consultar los datos del inventario
$sql = "SELECT i.Id_producto, i.Cantidad
        FROM Inventario i
        WHERE i.Id_inventario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_inventario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No se encontraron datos']);
}

$stmt->close();
$conn->close();
