<?php
header('Content-Type: application/json');

session_start();

require_once("../../Conexion/conn.php");

$method = $_SERVER['REQUEST_METHOD'];

if (!isset($_SESSION['clientId'])) {
    echo json_encode(["success" => false, "message" => "Usuario no autenticado."]);
    exit;
}

$clientId = $_SESSION['clientId'];

switch ($method) {
    case 'GET':
        // Obtener el carrito de compras
        $stmt = $conn->prepare("SELECT dp.Id_detalle, p.Nombre_producto, dp.Cantidad, p.Precio, (dp.Cantidad * p.Precio) AS Total
                                FROM Detalle_Pedido dp
                                JOIN Producto p ON dp.Id_producto = p.Id_producto
                                JOIN Pedido pe ON dp.Id_pedido = pe.Id_pedido
                                WHERE pe.Id_cliente = ? AND pe.Estado = 'pendiente'");
        $stmt->bind_param("i", $clientId);
        $stmt->execute();
        $result = $stmt->get_result();
        $carrito = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(["success" => true, "data" => $carrito]);
        break;

    case 'POST':
        // Añadir producto al carrito
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['productId']) && isset($data['quantity'])) {
            $productId = $data['productId'];
            $quantity = $data['quantity'];

            // Verificar si hay un pedido pendiente
            $stmt = $conn->prepare("SELECT Id_pedido FROM Pedido WHERE Id_cliente = ? AND Estado = 'pendiente'");
            $stmt->bind_param("i", $clientId);
            $stmt->execute();
            $result = $stmt->get_result();
            $pedido = $result->fetch_assoc();
            if ($pedido) {
                $pedidoId = $pedido['Id_pedido'];
            } else {
                // Crear un nuevo pedido si no hay uno pendiente
                $stmt = $conn->prepare("INSERT INTO Pedido (Id_cliente, Fecha_pedido, Estado) VALUES (?, NOW(), 'pendiente')");
                $stmt->bind_param("i", $clientId);
                $stmt->execute();
                $pedidoId = $stmt->insert_id;
            }

            // Añadir producto al carrito (Detalle_Pedido)
            $stmt = $conn->prepare("INSERT INTO Detalle_Pedido (Id_pedido, Id_producto, Cantidad, Tipo_envio, Total) 
                                    VALUES (?, ?, ?, 'N/A', (SELECT Precio FROM Producto WHERE Id_producto = ?) * ?) 
                                    ON DUPLICATE KEY UPDATE Cantidad = Cantidad + ?, Total = (SELECT Precio FROM Producto WHERE Id_producto = ?) * Cantidad");
            $stmt->bind_param("iiiiii", $pedidoId, $productId, $quantity, $productId, $quantity, $quantity, $productId);
            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al añadir producto al carrito."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Datos incompletos."]);
        }
        break;

    case 'DELETE':
        // Eliminar producto del carrito
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['productId'])) {
            $productId = $data['productId'];
            $stmt = $conn->prepare("DELETE dp
                                    FROM Detalle_Pedido dp
                                    JOIN Pedido p ON dp.Id_pedido = p.Id_pedido
                                    WHERE p.Id_cliente = ? AND dp.Id_producto = ? AND p.Estado = 'pendiente'");
            $stmt->bind_param("ii", $clientId, $productId);
            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al eliminar producto del carrito."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Datos incompletos."]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Método no soportado."]);
        break;
}

$conn->close();
