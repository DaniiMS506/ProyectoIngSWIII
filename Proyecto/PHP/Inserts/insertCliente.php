<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../Conexion/conn.php');

// Lee la entrada JSON
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nombre'], $data['apellido'], $data['email'], $data['password'], $data['telefono'], $data['direccion'])) {
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $email = $data['email'];
    $password = $data['password'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO Cliente (Nombre, Apellido, Email, Pass, Telefono, Direccion) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Preparation failed: " . $conn->error]);
        exit;
    }

    // Ejecutar la consulta
    if ($stmt->bind_param("ssssis", $nombre, $apellido, $email, $password, $telefono, $direccion) && $stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Usuario registrado exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Execution failed: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
}
