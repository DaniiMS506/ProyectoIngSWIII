<?php
/*
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
        echo json_encode(["success" => false, "message" => "Correo electrónico o contraseña no válidos."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Se requiere correo electrónico y contraseña."]);
}*/
header('Content-Type: application/json');

// Habilitar la visualización de errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../Conexion/conn.php");

// Iniciar la sesión
session_start();

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

        // Guardar datos del usuario en la sesión
        $_SESSION['clientId'] = $user['Id_cliente'];
        $_SESSION['clientName'] = $user['Nombre'] . ' ' . $user['Apellido'];
        $_SESSION['clientEmail'] = $user['Email'];

        echo json_encode(["success" => true, "data" => $user]);
    } else {
        echo json_encode(["success" => false, "message" => "Correo electrónico o contraseña no válidos."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Se requiere correo electrónico y contraseña."]);
}
