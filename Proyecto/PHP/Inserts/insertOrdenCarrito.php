<?php
session_start();
require_once('../../Conexion/conn.php');

$action = $_POST['action'] ?? '';
$productId = $_POST['productId'] ?? '';
$quantity = $_POST['quantity'] ?? 1;

if ($action === 'add') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    echo json_encode(['success' => true, 'message' => 'Product added to cart']);
    exit;
}

if ($action === 'get') {
    $cart = $_SESSION['cart'] ?? [];
    $response = [];

    foreach ($cart as $id => $qty) {
        $stmt = $conn->prepare("SELECT Nombre_producto, Precio FROM Producto WHERE Id_producto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $product['quantity'] = $qty;
        $response[] = $product;
    }

    echo json_encode($response);
    exit;
}

if ($action === 'checkout') {
    $clientId = $_SESSION['clientId'] ?? 0; // Make sure clientId is set on login

    if (!$clientId) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    $total = 0;
    $cart = $_SESSION['cart'] ?? [];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO Pedido (Id_cliente, Fecha_pedido, Estado) VALUES (?, NOW(), 'pendiente')");
        $stmt->bind_param("i", $clientId);
        $stmt->execute();
        $orderId = $conn->insert_id;

        foreach ($cart as $id => $qty) {
            $stmt = $conn->prepare("SELECT Precio FROM Producto WHERE Id_producto = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $price = $product['Precio'];
            $total += $price * $qty;

            $stmt = $conn->prepare("INSERT INTO Detalle_Pedido (Id_pedido, Id_producto, Cantidad, Tipo_envio, Total) VALUES (?, ?, ?, 'estándar', ?)");
            $stmt->bind_param("iiid", $orderId, $id, $qty, $price);
            $stmt->execute();
        }

        $stmt = $conn->prepare("UPDATE Pedido SET Total = ? WHERE Id_pedido = ?");
        $stmt->bind_param("di", $total, $orderId);
        $stmt->execute();

        $conn->commit();
        unset($_SESSION['cart']);
        echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Order failed']);
    }

    exit;
}
