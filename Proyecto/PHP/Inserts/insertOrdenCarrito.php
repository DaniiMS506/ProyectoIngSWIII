<?php
header('Content-Type: application/json');

session_start();

require_once("../../Conexion/conn.php");

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$method = $_SERVER['REQUEST_METHOD'];

// Verificar si el usuario está autenticado
if (!isset($_SESSION['clientId'])) {
    echo json_encode(["success" => false, "message" => "Usuario no autenticado."]);
    exit;
}

$clientId = $_SESSION['clientId'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Registro de los datos recibidos
    error_log("Datos recibidos: " . print_r($data, true));

    // Validar datos recibidos
    if ($data === null || !isset($data['cart']) || !is_array($data['cart'])) {
        error_log("Datos del carrito inválidos: " . print_r($data, true));
        echo json_encode(["success" => false, "message" => "Datos del carrito inválidos."]);
        exit;
    }

    $cart = $data['cart'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO Pedido (Id_cliente, Fecha_pedido, Estado) VALUES (?, NOW(), 'pendiente')");
        $stmt->bind_param("i", $clientId);
        $stmt->execute();
        $pedidoId = $stmt->insert_id;

        $stmt = $conn->prepare("
            INSERT INTO Detalle_Pedido (Id_pedido, Id_producto, Cantidad, Tipo_envio, Total) 
            VALUES (?, ?, ?, 'N/A', (SELECT Precio FROM Producto WHERE Id_producto = ?) * ?)
        ");

        foreach ($cart as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];

            $stmt->bind_param("iiiii", $pedidoId, $productId, $quantity, $productId, $quantity);
            $stmt->execute();
        }

        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Error en la base de datos: " . $e->getMessage());
        echo json_encode(["success" => false, "message" => "Error en la base de datos: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no soportado."]);
}

$conn->close();
