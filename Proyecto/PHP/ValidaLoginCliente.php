<?php
header('Content-Type: application/json');

// Habilitar la visualización de errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../Conexion/conn.php");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email']) && isset($data['password'])) {
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $conn->prepare("SELECT * FROM Cliente WHERE Email = ? AND Pass = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Preparation failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ss", $email, $password);
    if (!$stmt->execute()) {
        echo json_encode(["success" => false, "message" => "Execution failed: " . $stmt->error]);
        exit;
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode(["success" => true, "data" => $user]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid email or password."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Email and password required."]);
}
