<?php
require_once('../../Conexion/conn.php');

// Obtener los datos de la solicitud
$nombreCategoria = $_REQUEST["Nombre_categoria"];
$descripcion = $_REQUEST["Descripcion"]; 
// Insertar en la tabla Usuario
$sqlUsuario = "INSERT INTO categoria (Nombre_categoria, Descripcion) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sqlUsuario);
mysqli_stmt_bind_param($stmt, 'ss', $nombreCategoria, $descripcion);

$response = array();

try {
    if (mysqli_stmt_execute($stmt)) {
        // Obtener el ID de la fila insertada
        $insertedId = mysqli_insert_id($conn);

        // Devolver los datos insertados en formato JSON
        $response['status'] = 'success';
        $response['data'] = array(
            'id' => $insertedId,
            'nombreCategoria' => $nombreCategoria,
            'descripcion' => $descripcion
        );
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error al ingresar al sistema';
    }
    mysqli_stmt_close($stmt);
} catch (mysqli_sql_exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'No tiene acceso: ' . $e->getMessage();
}

// Configurar la cabecera de la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar conexión
mysqli_close($conn);
