<?php
require_once('../../../Conexion/conn.php');

$id_categoria = $_POST['Id_categoria'];

// Consultar los datos del inventario
$sql = "SELECT *
        FROM categoria
        WHERE Id_categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_categoria);
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
