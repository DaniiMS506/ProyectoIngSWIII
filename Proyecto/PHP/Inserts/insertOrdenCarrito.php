<?php
// Establece el tipo de contenido a JSON para la respuesta
header('Content-Type: application/json');

// Inicia la sesión para manejar la autenticación del usuario
session_start();

require_once("../../Conexion/conn.php");

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtiene el método de la solicitud (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Verificar si el usuario está autenticado
if (!isset($_SESSION['clientId'])) {
    echo json_encode(["success" => false, "message" => "Usuario no autenticado."]);
    exit;
}

$clientId = $_SESSION['clientId'];

// Verifica si el método de la solicitud es POST
if ($method === 'POST') {
    // Lee los datos JSON del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Registro de los datos recibidos
    error_log("Datos recibidos: " . print_r($data, true));

    // Validar datos recibidos
    if ($data === null || !isset($data['cart']) || !is_array($data['cart'])) {
        error_log("Datos del carrito inválidos: " . print_r($data, true));
        echo json_encode(["success" => false, "message" => "Datos del carrito inválidos."]);
        exit;
    }

    // Obtiene lso datos del carrito
    $cart = $data['cart'];

    // Inicia una transacción
    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO Pedido (Id_cliente, Fecha_pedido, Estado) VALUES (?, NOW(), 'pendiente')");
        $stmt->bind_param("i", $clientId); // Asocia el parámetro clientId
        $stmt->execute();
        $pedidoId = $stmt->insert_id; // Obtiene el ID del nuevo pedido

        $stmt = $conn->prepare("
            INSERT INTO Detalle_Pedido (Id_pedido, Id_producto, Cantidad, Tipo_envio, Total) 
            VALUES (?, ?, ?, 'Express', (SELECT Precio FROM Producto WHERE Id_producto = ?) * ?)
        ");

        // Itera sobre cada artículo en el carrito
        foreach ($cart as $item) {
            $productId = $item['id']; // Obtiene el ID del producto
            $quantity = $item['quantity']; // Obtiene la cantidad del producto

            $stmt->bind_param("iiiii", $pedidoId, $productId, $quantity, $productId, $quantity);
            $stmt->execute();                                //Cantidad              //Calculo del Total en base a cantidad y select del precio del producto
        }

        // Guarda la transacción
        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        // Si ocurre un error, revierte la transacción
        $conn->rollback();
        error_log("Error en la base de datos: " . $e->getMessage());
        echo json_encode(["success" => false, "message" => "Error en la base de datos: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método no soportado."]);
}

$conn->close();
