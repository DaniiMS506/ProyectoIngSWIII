<?php
require_once('../../Conexion/conn.php');

$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$email = $_REQUEST["Email"];
$pass = $_REQUEST["contrasena"];
$id_rol = $_REQUEST["id_rol"];

// Insertar en la tabla Usuario
$sqlUsuario = "INSERT INTO Usuario (Nombre, Apellido, Email, Password, Id_rol) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sqlUsuario);
mysqli_stmt_bind_param($stmt, 'ssssi', $nombre, $apellidos, $email, $pass, $id_rol);

try {
    if (mysqli_stmt_execute($stmt)) {
        echo "Ingresado al sistema";
    } else {
        echo "Error al ingresar al sistema";
    }
    mysqli_stmt_close($stmt);
} catch (mysqli_sql_exception $e) {
    echo "No tiene acceso: " . $e->getMessage();
}

mysqli_close($conn);
?>