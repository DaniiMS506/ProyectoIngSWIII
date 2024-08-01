<?php
include('Conexion/conn.php');


// Obtener productos más vendidos y sumar cantidades
$sqlProductosVendidos = "SELECT p.Nombre_producto AS nombre_producto, SUM(dp.Cantidad) AS unidades
                        FROM Detalle_Pedido dp
                        INNER JOIN Producto p ON dp.Id_producto = p.Id_producto
                        GROUP BY p.Nombre_producto
                        ORDER BY unidades DESC LIMIT 5";

$resultProductosVendidos = $conn->query($sqlProductosVendidos);



// Obtener últimas ventas
$sqlUltimasVentas = "SELECT p.Nombre_producto AS nombre_producto, dp.Cantidad AS unidades, 
                            DATE_FORMAT(ped.Fecha_pedido, '%Y/%m/%d') AS fecha
                    FROM Detalle_Pedido dp
                    INNER JOIN Producto p ON dp.Id_producto = p.Id_producto
                    INNER JOIN Pedido ped ON dp.Id_pedido = ped.Id_pedido
                    ORDER BY ped.Fecha_pedido DESC LIMIT 5";

$resultUltimasVentas = $conn->query($sqlUltimasVentas);



// Obtener productos recientemente añadidos
$sqlProductosRecientes = "SELECT Nombre_producto AS nombre, 
                                DATE_FORMAT(Fecha_expiracion, '%Y/%m/%d') AS fecha_adicion
                        FROM Producto
                        ORDER BY Fecha_expiracion DESC 
                        LIMIT 5";
                        
$resultProductosRecientes = $conn->query($sqlProductosRecientes);

// Cerrar conexión
$conn->close();
?>